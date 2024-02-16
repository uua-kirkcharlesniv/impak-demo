<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormScheduleComponent extends Component
{
    use LivewireAlert;

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
        $currentStartDate = Carbon::parse($this->survey->start_date);
        $startDate = Carbon::parse($data);
        $endDate = Carbon::parse($this->survey->end_date);

        if ($startDate->lte($endDate)) {
            $this->survey->start_date = $startDate->format('Y-m-d H:i:s');
            $this->survey->save();
        } else {
            /// Reset the start date to the current start date
            // $this->survey->start_date = $currentStartDate->format('Y-m-d H:i:s');

            $this->alert('error', 'Start date must be less than end date');
        }
    }

    public function onEndDateChanged($data)
    {
        $currentEndDate = Carbon::parse($this->survey->end_date);

        $startDate = Carbon::parse($this->survey->start_date);
        $endDate = Carbon::parse($data);

        if ($endDate->gte($startDate)) {
            $this->survey->end_date = $endDate->format('Y-m-d H:i:s');
            $this->survey->save();
        } else {
            /// Reset the end date to the current end date
            // $this->survey->end_date = $currentEndDate->format('Y-m-d H:i:s');

            $this->alert('error', 'End date must be greater than start date');
        }
    }

    public function onStartTimeChanged($data)
    {
        $startTime = Carbon::parse($data);
        $endTime = Carbon::parse($this->survey->end_time);

        if ($startTime->lte($endTime)) {
            $this->survey->start_time = $data;
            $this->survey->save();
        } else {
            $this->alert('error', 'Start time must be less than end time');
        }
    }

    public function onEndTimeChanged($data)
    {
        $startTime = Carbon::parse($this->survey->start_time);
        $endTime = Carbon::parse($data);

        if ($endTime->gte($startTime)) {
            $this->survey->end_time = $data;
            $this->survey->save();
        } else {
            $this->alert('error', 'End time must be greater than start time');
        }
    }

    public function updatedRecurrentDays()
    {
        $this->survey->recurrent_days = $this->recurrent_days;
        $this->survey->save();

        Log::debug($this->recurrent_days);
    }
}
