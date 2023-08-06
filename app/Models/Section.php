<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;


class Section extends \MattDaneshvar\Survey\Models\Section
{
    protected $fillable = ['name', 'sort_order'];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });

        static::creating(function ($section) {
            if (isset($section->sort_order)) {
                $section->sort_order = $section->sort_order;
            } else {
                // Get the last highest sort value
                $lastSortValue = static::where('survey_id', $section->survey_id)->max('sort_order');

                // Increment the last sort value by 1
                $section->sort_order = $lastSortValue + 1;
            }
        });
    }
}
