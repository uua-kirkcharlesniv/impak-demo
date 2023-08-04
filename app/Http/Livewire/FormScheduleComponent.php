<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class FormScheduleComponent extends Component
{
    public Survey $survey;

    public $recurrent_days = [];

    protected $rules = [
        'survey.start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
        'survey.end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
        'survey.start_time' => 'nullable|date_format:H:i',
        'survey.end_time' => 'nullable|date_format:H:i',
    ];

    public function render()
    {
        return view('livewire.form-schedule-component');
    }

    public function mount($survey)
    {
        $this->survey = $survey;
        if (isset($survey->recurrent_days)) {
            $this->recurrent_days = $survey->recurrent_days;
        } else {
            $this->recurrent_days = [];
        }
    }

    public function onStartDateChanged($data)
    {
        $startDate = Carbon::parse($data);
        $endDate = Carbon::parse($this->survey->end_date);

        if ($startDate->lte($endDate)) {
            $this->survey->start_date = $startDate->format('Y-m-d H:i:s');
            $this->survey->save();
        }
    }

    public function onEndDateChanged($data)
    {
        $startDate = Carbon::parse($this->survey->start_date);
        $endDate = Carbon::parse($data);

        if ($endDate->gte($startDate)) {
            $this->survey->end_date = $endDate->format('Y-m-d H:i:s');
            $this->survey->save();
        }
    }

    public function onStartTimeChanged($data)
    {
        $startTime = Carbon::parse($data);
        $endTime = Carbon::parse($this->survey->end_time);

        if ($startTime->lte($endTime)) {
            $this->survey->start_time = $data;
            $this->survey->save();
        }
    }

    public function onEndTimeChanged($data)
    {
        $startTime = Carbon::parse($this->survey->start_time);
        $endTime = Carbon::parse($data);

        if ($endTime->gte($startTime)) {
            $this->survey->end_time = $data;
            $this->survey->save();
        }
    }

    public function updatedRecurrentDays()
    {
        $this->survey->recurrent_days = $this->recurrent_days;
        $this->survey->save();

        Log::debug($this->recurrent_days);
    }
}
