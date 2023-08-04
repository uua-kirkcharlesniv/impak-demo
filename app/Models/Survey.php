<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MattDaneshvar\Survey\Models\Entry;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Survey extends \MattDaneshvar\Survey\Models\Survey
{
    use HasSlug;

    protected $fillable = ['name', 'settings', 'rationale', 'rationale_description', 'survey_type', 'manual_survey_type', 'manual_sections', 'target_focus'];

    protected $casts = [
        'recurrent_days' => 'array',
        'settings' => 'array',
    ];

    protected $appends = ['is_open', 'is_targeted', 'target_user_ids', 'respondents_count', 'unique_users_entry_count'];

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
        $data = Entry::where('survey_id', $this->id)->distinct()->get()->count();
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
        $isTargeted = $this->getIsTargetedAttribute();
        if ($isTargeted == false) {
            return false;
        }

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
}
