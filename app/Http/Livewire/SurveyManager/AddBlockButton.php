<?php

namespace App\Http\Livewire\SurveyManager;

use Carbon\Carbon;
use Livewire\Component;

class AddBlockButton extends Component
{
    public function render()
    {
        return view('livewire.survey-manager.add-block-button');
    }

    public function pick($type)
    {
        $title = '';
        $isRequired = true;
        $nameHidden = false;
        $validation = [];
        $additionals = [];

        switch ($type) {
            case 'short-answer':
                $title = 'Short Answer Field';

                $additionals['prefill'] = '';
                $additionals['placeholder'] = '';
                $additionals['helper'] = '';

                $validation['max'] = 250;
                break;
            case 'long-answer':
                $title = 'Long Answer Field';

                $additionals['prefill'] = '';
                $additionals['placeholder'] = '';
                $additionals['helper'] = '';

                $validation['max'] = 1000;
                break;
            case 'date':
                $title = 'Date Field';

                $validation['min'] = Carbon::now()->subMonths(1)->toDateString();
                $validation['max'] = Carbon::now()->addMonths(1)->toDateString();
                break;
            case 'time':
                $title = 'Time Field';

                $validation['min'] = '08:00';
                $validation['max'] = '18:00';
                break;
            case 'checkbox':
                $title = 'Checkbox Field';

                $additionals['helper'] = '';
                break;
            case 'radio':
                $title = 'Radio Field';

                $additionals['helper'] = '';
                break;
            case 'likert':
                $title = 'Likert Scale Field';

                $additionals['prefill'] = 5;
                $additionals['helper'] = '';
                break;
            case 'radio-grid':
                $title = 'Radio Grid';

                $additionals['helper'] = '';
                break;
            case 'photo':
                $title = 'Photo Upload';

                $additionals['helper'] = '';
                break;
            case 'document':
                $title = 'Document Upload';

                $additionals['helper'] = '';
                break;
        }

        $data = [
            'type' => $type,
            'title' => $title,
            'is_required' => $isRequired,
            'is_name_hidden' => $nameHidden,
            'max' => 250,
        ];

        $this->emitUp('addBlock', $data);
    }
}
