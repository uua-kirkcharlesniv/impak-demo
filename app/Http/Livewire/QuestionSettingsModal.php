<?php

namespace App\Http\Livewire;

use App\Models\Question;
use App\Models\Survey;
use Livewire\Component;

class QuestionSettingsModal extends Component
{
    public Question $question;

    protected $rules = [
        'question.content' => 'required|max:250|min:2|string',
    ];

    public $isRequired = false;
    public $min = 0;
    public $max = 250;
    public $newOptionName = '';

    public function render()
    {
        return view('livewire.question-settings-modal');
    }

    public function mount($question)
    {
        $this->question = $question;
        $this->isRequired = $question->is_required;
        $this->min = $question->min;
        $this->max = $question->max;
    }

    public function onContentChanged($data)
    {
        $this->validate();

        $this->question->update(['content' => $data]);
    }

    public function updatedIsRequired($data)
    {
        $rules = $this->question->rules;
        $isRequiredNow = $data;
        if (!$isRequiredNow) {
            $index = array_search('required', $rules);

            if ($index !== FALSE) {
                unset($rules[$index]);
            }

            array_push($rules, 'nullable');
        } else {
            $index = array_search('nullable', $rules);

            if ($index !== FALSE) {
                unset($rules[$index]);
            }

            array_push($rules, 'required');
        }

        $this->question->update(['rules' => $rules]);
    }

    public function updatedMin($data)
    {
        $rules = $this->question->rules;

        if (!$data) {
            foreach ($rules as $key => $value) {
                if (strpos($value, "min:") === 0) {
                    unset($rules[$key]);
                    break;
                }
            }
        } else if ($data < $this->question->max) {
            $exists = false;
            foreach ($rules as $key => $value) {
                if (strpos($value, "min:") === 0) {
                    $rules[$key] = "min:" . $data;
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $rules[] = "min:" . $data;
            }
        }

        $this->question->update(['rules' => $rules]);
    }

    public function updatedMax($data)
    {
        $rules = $this->question->rules;

        if ($this->question->type == 'multiselect') {
            $choicesCount = count($this->question->options);

            if ($choicesCount == 0) {
                foreach ($rules as $key => $value) {
                    if (strpos($value, "max:") === 0) {
                        $rules[$key] = "max:0";
                        break;
                    }
                }
            } else if ($data > 0 && $data <= $choicesCount) {
                foreach ($rules as $key => $value) {
                    if (strpos($value, "max:") === 0) {
                        $rules[$key] = "max:" . $data;
                        break;
                    }
                }
            }
        } else {
            if (!$data) {
                foreach ($rules as $key => $value) {
                    if (strpos($value, "max:") === 0) {
                        $rules[$key] = "max:250";
                        break;
                    }
                }
            } else {
                $exists = false;
                foreach ($rules as $key => $value) {
                    if (strpos($value, "max:") === 0) {
                        $rules[$key] = "max:" . $data;
                        $exists = true;
                        break;
                    }
                }

                if (!$exists) {
                    $rules[] = "max:" . $data;
                }
            }
        }

        $this->question->update(['rules' => $rules]);
    }

    public function createNewOption()
    {
        if (!$this->newOptionName) {
            return;
        }

        $choices = $this->question->options;

        array_push($choices, $this->newOptionName);

        $this->newOptionName = '';

        $this->question->update(['options' => $choices]);
    }

    public function deleteOption($index)
    {
        if ($index < 0) return;
        if (count($this->question->options) <= 0) return;

        $choices = $this->question->options;
        unset($choices[$index]);

        $this->question->update(['options' => $choices]);
    }

    public function modalClosed()
    {
        $this->emit('modalClosed');
    }
}
