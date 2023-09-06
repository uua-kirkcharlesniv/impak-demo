<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use MattDaneshvar\Survey\Models\Entry;

class SurveyAnswerPage extends Component
{
    public Survey $survey;

    public $isAtStart = true;
    public $isAtEnd = false;

    public $currentSection = 0;
    public $currentQuestion = 0;
    public $totalSections = 0;
    public $totalQuestions = [];

    public $answers = [];

    public $answer;

    public $startTime;
    public $endTime;
    public $points = 0;

    public function calculateRemainingTime()
    {
        $now = now();
        $secondsRemaining = max(0, $this->endTime->diffInSeconds($now));
        $minutes = floor($secondsRemaining / 60);
        $seconds = $secondsRemaining % 60;
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function mount(Survey $survey)
    {
        $this->startTime = Carbon::now();
        $this->endTime = Carbon::now()->addMinutes(5);

        $this->survey = $survey;
        $this->totalSections = $survey->sections()->count();

        $localTotalQuestions = [];
        foreach ($survey->sections as $section) {
            array_push($localTotalQuestions, $section->questions()->count());
        }

        $this->totalQuestions = $localTotalQuestions;
    }

    public function calculatePoints($data)
    {
        if (is_array($data)) {
            $this->points += count($data) * 3;
        }

        if ($this->question->type == 'radio' || $this->question->type == 'likert') {
            $this->points += rand(1, 2);
        }

        if ($this->question->type == 'short-answer' || $this->question->type == 'long-answer') {
            $this->points += strlen($data) * rand(1, 1.5);
        }

        $this->points += rand(1, 1.6);

        $this->points = round($this->points);
    }

    public function nextQuestion()
    {
        Validator::make([
            $this->question->key => $this->answer,
        ], [
            $this->question->key => $this->question->rules,
        ], [
            'required' => 'This field is required',
            'min' => 'Must at least pick :min choices.',
            'max' => 'Maximum of :max choices only.'
        ])->validate();

        $this->calculatePoints($this->answer);

        $this->answers = array_merge($this->answers, [$this->question->key => $this->answer]);

        if ($this->currentQuestion < $this->totalQuestions[$this->currentSection] - 1) {
            $this->currentQuestion++;
        } else {
            if ($this->currentSection < $this->totalSections - 1) {
                $this->currentSection++;
                $this->currentQuestion = 0; // Reset to the first question of the next section
            } else {
                $this->processEnd();
            }
        }

        $this->forgetComputed();

        if ($this->question->type == 'multiselect') {
            $this->answer = [];
        } else {
            $this->answer = null;
        }
    }

    public function getAnsweredQuestionsCountProperty()
    {
        $answeredQuestionsCount = 0;

        for ($i = 0; $i < $this->currentSection; $i++) {
            $answeredQuestionsCount += $this->totalQuestions[$i];
        }

        $answeredQuestionsCount += $this->currentQuestion;

        return $answeredQuestionsCount;
    }

    public function getCurrentSectionDataProperty()
    {
        return $this->survey->sections[$this->currentSection];
    }

    public function getQuestionProperty()
    {
        return $this->getCurrentSectionDataProperty()->questions[$this->currentQuestion];
    }

    public function getProgressPercentageProperty()
    {
        $totalQuestionsCount = array_sum($this->totalQuestions);
        $answeredQuestionsCount = $this->getAnsweredQuestionsCountProperty();

        return ($answeredQuestionsCount / $totalQuestionsCount) * 100;
    }

    // Start and End functions
    public function processStart()
    {
        $this->isAtStart = false;
    }

    public function processEnd()
    {
        (new Entry)->for($this->survey)->by(Auth::user())->fromArray($this->answers)->push();

        $this->isAtEnd = true;
    }

    public function render()
    {
        return view('livewire.survey-answer-page');
    }
}
