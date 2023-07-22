<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Survey;
use Exception;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Survey::paginate(9);
        return view('pages/campaigns', compact('campaigns'));
    }

    public function view()
    {
        return view('pages/campaign/answer/intro');
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
