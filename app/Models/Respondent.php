<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    protected $table = 'survey_respondents';

    use HasFactory;

    public function surveys()
    {
        return $this->belongsToMany(Survey::class, 'survey_respondents', 'respondent_id', 'survey_id')
            ->withPivot('type')
            ->withTimestamps();
    }
}
