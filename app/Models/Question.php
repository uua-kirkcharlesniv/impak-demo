<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Question extends \MattDaneshvar\Survey\Models\Question
{
    protected $appends = ['is_required', 'formatted_type', 'max', 'min', 'likert_type', 'likert_order'];

    protected $casts = [
        'is_required' => 'boolean',
        'options' => 'array',
        'rules' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });

        static::creating(function ($question) {
            // Get the last highest sort value
            $lastSortValue = static::where('section_id', $question->section_id)->max('sort_order');

            // Increment the last sort value by 1
            $question->sort_order = $lastSortValue + 1;
        });
    }

    public function getIsRequiredAttribute()
    {
        return in_array('required', $this->rules);
    }

    public function getMaxAttribute()
    {
        $max = array_filter($this->rules, function ($rule) {
            return str_starts_with($rule, 'max:');
        });

        if (count($max) > 0) {
            $maxLength = intval(explode(':', array_values($max)[0])[1]);
            return $maxLength;
        }

        return null;
    }

    public function getLikertTypeAttribute()
    {
        if ($this->type != 'likert') {
            return null;
        }

        if (in_array('full', $this->options)) {
            return 5;
        }

        if (in_array('boolean', $this->options)) {
            return 2;
        }

        if (in_array('tristate', $this->options)) {
            return 3;
        }

        return null;
    }

    public function getLikertOrderAttribute()
    {
        if ($this->type != 'likert') {
            return null;
        }

        if (in_array('desc', $this->options)) {
            return false;
        }

        return true;
    }

    public function getMinAttribute()
    {
        $min = array_filter($this->rules, function ($rule) {
            return str_starts_with($rule, 'min:');
        });

        if (count($min) > 0) {
            $minLength = intval(explode(':', array_values($min)[0])[1]);
            return $minLength;
        }

        return null;
    }

    public function getTypeAttribute($data)
    {
        if ($data == 'text') {
            $max = array_filter($this->rules, function ($rule) {
                return str_starts_with($rule, 'max:');
            });

            if (count($max) > 0) {
                $maxLength = intval(explode(':', array_values($max)[0])[1]);
                if ($maxLength > 250) {
                    return 'long-answer';
                } else {
                    return 'short-answer';
                }
            } else {
                $dateFormat = array_filter($this->rules, function ($rule) {
                    return str_starts_with($rule, 'date_format:');
                });
                if (count($dateFormat) <= 0) return 'short-answer';

                $parsedValue = explode(':', array_values($dateFormat)[0], 2)[1];

                if (count($dateFormat) > 0) {

                    $containsTime = str_contains($parsedValue, ':');
                    $containsDate = str_contains($parsedValue, '/');

                    if ($containsDate && $containsTime) {
                        return 'datetime';
                    } else if ($containsDate) {
                        return 'date';
                    } else if ($containsTime) {
                        return 'time';
                    }

                    dd($parsedValue);
                } else {
                    // no matches, return 'text'
                    return 'text';
                }
            }
        }

        return $data;
    }

    public function getFormattedTypeAttribute()
    {
        switch ($this->type) {
            case 'long-answer':
                return 'Long Answer';
                break;
            case 'short-answer':
                return 'Short Answer';
                break;
            case 'date':
                return 'Date';
                break;
            case 'time':
                return 'Time';
                break;
            case 'time':
                return 'Date & Time';
                break;
            case 'radio':
                return 'Radio';
                break;
            case 'likert':
                return 'Likert Scale';
                break;
            case 'multiselect':
                return 'Checkbox';
                break;
            case 'range':
                return 'Range Slider';
                break;
            default:
                return 'Unsupported';
                break;
        }
    }
}
