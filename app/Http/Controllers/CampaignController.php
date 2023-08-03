<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Survey;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use MattDaneshvar\Survey\Models\Entry;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Survey::paginate(9);
        return view('pages/campaigns', compact('campaigns'));
    }

    public function view($id)
    {
        $survey = Survey::findOrFail($id);
        return view('pages/campaign/answer/intro')->with('survey', $survey);
    }

    public function store($id, Request $request)
    {
        $survey = Survey::findOrFail($id);
        
        $answers = $this->validate($request, $survey->rules, [
            'required' => 'This field is required',
            'min' => 'Must at least pick :min choices.',
            'max' => 'Maximum of :max choices only.'
        ]);

        (new Entry)->for($survey)->by(Auth::user())->fromArray($answers)->push();
    }

    public function answer1()
    {
        return view('pages/campaign/answer/dropdown');
    }

    public function answer2()
    {
        return view('pages/campaign/answer/datetime');
    }


    public function answer3()
    {
        return view('pages/campaign/answer/text');
    }

    public function answer4()
    {
        return view('pages/campaign/answer/upload');
    }

    public function completed()
    {
        return view('pages/campaign/answer/completed');
    }


    public function create()
    {
        try {
            $survey = Survey::create([
                'name' => 'My New ' . Str::title(tenant()->company) . ' Survey',
                'settings' => [
                    'limit-per-participant' => 1,
                    'accept-guest-entries' => false,
                ],
                'rationale' => '',
                'rationale_description' => '',
                'survey_type' => 'post_event',
                'recurrent_days' => []
            ]);
        } catch (Exception $e) {
            dd($e);
        }


        return redirect()->route('survey.edit', [$survey]);
    }
}
