<?php

namespace App\Models;

use App\Events\SurveyPublished;
use Brick\Math\Exception\DivisionByZeroException;
use Carbon\Carbon;
use DivisionByZeroError;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MattDaneshvar\Survey\Models\Entry;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Survey extends \MattDaneshvar\Survey\Models\Survey
{
    use HasSlug;

    protected $fillable = ['name', 'publish_status', 'settings', 'rationale', 'rationale_description', 'survey_type', 'manual_survey_type', 'manual_sections', 'target_focus', 'framework_id', 'start_date', 'end_date', 'start_time', 'end_time'];

    protected $casts = [
        'recurrent_days' => 'array',
        'settings' => 'array',
    ];

    protected $appends = ['is_open', 'is_targeted', 'target_user_ids', 'respondents_count', 'unique_users_entry_count', 'completion_percent', 'photo', 'last_entry_date', 'open_at'];

    protected $dispatchesEvents = [
        'updated' => SurveyPublished::class,
    ];

    public function getCompletionPercentAttribute()
    {
        try {
            return number_format((float) $this->getUniqueUsersEntryCountAttribute() / $this->getRespondentsCountAttribute(), 2, '.', '');
        } catch (DivisionByZeroError $e) {
            return 0;
        }
    }

    public function getLastEntryDateAttribute()
    {
        $lastEntry = $this->lastEntry(Auth::user());
        if ($lastEntry) {
            return Carbon::parse($lastEntry->created_at)->setTimezone('Asia/Manila')->format('h:i A, M d');
        }
    }

    public function getOpenAtAttribute()
    {
        return Carbon::parse($this->end_time)->setTimezone('Asia/Manila')->format('h:i A') . ", " . Carbon::parse($this->end_date)->setTimezone('Asia/Manila')->format('M d');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getTargetUserIdsAttribute()
    {
        $users = Respondent::where('survey_id', $this->id)
            ->where('type', 'user')
            ->get()->pluck('respondent_id')->toArray();

        $groupIds = Respondent::where('survey_id', $this->id)
            ->where('type', 'group')
            ->get()->pluck('respondent_id')->toArray();
        $groupUserIds = [];
        foreach ($groupIds as $id) {
            $myArray = DB::table('group_user')->where('group_id', '=', $id)->get()->pluck('user_id')->toArray();
            $groupUserIds = array_merge($myArray, $groupUserIds);
            Log::debug($myArray);
        }

        $departmentUserIds = [];
        $departmentIds = Respondent::where('survey_id', $this->id)
            ->where('type', 'department')
            ->get()->pluck('respondent_id')->toArray();
        foreach ($departmentIds as $id) {
            $myArray = DB::table('department_user')->where('department_id', '=', $id)->get()->pluck('user_id')->toArray();
            $departmentUserIds = array_merge($myArray, $departmentUserIds);
        }


        return array_unique(array_merge($users, $groupUserIds, $departmentUserIds));
    }

    public function getRespondentsCountAttribute()
    {
        return count($this->target_user_ids);
    }

    public function getUniqueUsersEntryCountAttribute()
    {
        $data = Entry::select('participant_id')->where('survey_id', $this->id)->groupBy('participant_id')->get()->count();
        return $data;
    }

    public function getEndTimeAttribute($data)
    {
        if (isset($this->attributes['start_time']) && !isset($data)) {
            return '23:59';
        }

        return $data;
    }

    public function getIsTargetedAttribute()
    {

        if (Auth::check()) {
            $userId = Auth::user()->id;
            return in_array($userId, $this->target_user_ids);
        } else {
            return $this->acceptsGuestEntries();
        }

        return false;
    }


    public function getIsOpenAttribute()
    {
        if ($this->publish_status == 'draft' || $this->publish_status == 'closed') {
            return;
        }

        if (Auth::user()->hasRole('employee')) {
            $eligiblity = $this->isEligible(Auth::user());

            if ($eligiblity == false) {
                return false;
            }
        }

        $isTargeted = $this->getIsTargetedAttribute();
        if ($isTargeted == false) {
            return false;
        }

        return true;

        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i');
        $currentDayOfWeek = Carbon::now()->dayOfWeek; // Carbon returns 0 for Sunday, 1 for Monday, and so on.

        // Check if it's within the start and end date
        if ($currentDate >= $this->start_date && $currentDate <= $this->end_date) {
            // If recurrent_days is empty or null, it's always open within the start and end date
            if (empty($this->recurrent_days)) {
                // Check if start and end time are also null or empty
                if (!$this->start_time && !$this->end_time) {
                    return true;
                }

                // If start and end time are null or empty, it's always open within the current day
                if (!$this->start_time || !$this->end_time) {
                    return true;
                }

                // Check if it's within the start and end time of the current day
                if ($currentTime >= $this->start_time && $currentTime <= $this->end_time) {
                    return true;
                }
            } else {
                // If recurrent_days is not empty, check if the current day is included in the recurrent_days array
                if (in_array($currentDayOfWeek, $this->recurrent_days)) {
                    // Check if start and end time are null or empty, it's always open on the recurrent days
                    if (!$this->start_time && !$this->end_time) {
                        return true;
                    }

                    // If start and end time are null or empty, it's always open within the current recurrent day
                    if (!$this->start_time || !$this->end_time) {
                        return true;
                    }

                    // Check if it's within the start and end time of the current recurrent day
                    if ($currentTime >= $this->start_time && $currentTime <= $this->end_time) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function respondents()
    {
        return $this->belongsToMany(Respondent::class, 'survey_respondents', 'survey_id', 'respondent_id')
            ->withPivot('type')
            ->withTimestamps();
    }

    public function getPhotoAttribute()
    {
        switch ($this->survey_type) {
            case 'post_event':
                return 'https://unsplash.com/photos/F2KRf_QfCqw/download?ixid=M3wxMjA3fDB8MXxzZWFyY2h8M3x8ZXZlbnR8ZW58MHx8fHwxNjkyNjMwNTcyfDA&force=true&w=640';
                break;
            case 'post_workshop':
                return 'https://plus.unsplash.com/premium_photo-1661713210744-f5be3c3491fe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80';
                break;
            case 'mental_wellness':
            case 'mental_health':
                return 'https://unsplash.com/photos/uGP_6CAD-14/download?ixid=M3wxMjA3fDB8MXxzZWFyY2h8Mnx8aGFwcHklMjBmZWVsaW5nfGVufDB8fHx8MTY5OTU2ODQ5MHww&force=true&w=640';
                break;
            case 'training_needs':
                return 'https://unsplash.com/photos/Oalh2MojUuk/download?ixid=M3wxMjA3fDB8MXxhbGx8fHx8fHx8fHwxNjk5NTczOTY5fA&force=true&w=640';
                break;
        }

        return 'https://unsplash.com/photos/nC6CyrVBtkU/download?ixid=M3wxMjA3fDB8MXxzZWFyY2h8M3x8Y29tcGFueXxlbnwwfHx8fDE2OTk5Mjg1ODd8MA&force=true&w=640';
    }
}
