<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Survey extends \MattDaneshvar\Survey\Models\Survey
{
    use HasSlug;

    protected $casts = [
        'recurrent_days' => 'array',
    ];

    protected $appends = ['is_open'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getEndTimeAttribute($data)
    {
        if (isset($this->attributes['start_time']) && !isset($data)) {
            return '23:59';
        }

        return $data;
    }

    public function getIsOpenAttribute()
    {
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
}
