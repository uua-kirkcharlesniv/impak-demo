<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Question extends \MattDaneshvar\Survey\Models\Question
{
    protected $appends = ['is_required', 'formatted_type'];

    protected $casts = [
        'is_required' => 'boolean',
        'options' => 'array',
        'rules' => 'array',
    ];

    public function getIsRequiredAttribute()
    {
        return in_array('required', $this->rules);
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
            default:
                return 'Unsupported';
                break;
        }
    }
}
