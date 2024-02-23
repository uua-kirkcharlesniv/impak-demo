<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Template;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use MattDaneshvar\Survey\Models\Entry;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Survey::latest();

        return view('pages/campaigns', compact('campaigns'));
    }

    public function drafts()
    {
        if (!Auth::user()->hasPermissionTo('manage-employees')) {
            abort(401);
        }

        $campaigns = Survey::where('publish_status', 'draft')->latest()->paginate(9);

        return view('pages/campaigns', compact('campaigns'));
    }

    public function ongoing()
    {
        if (Auth::user()->hasPermissionTo('manage-employees')) {
            $campaigns = Survey::where('publish_status', 'published')->latest()->paginate(9);
        } else {
            $campaigns = Survey::where('publish_status', 'published')->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->latest()->get();

            $user = Auth::user();

            $campaigns = $campaigns->filter(function ($survey) use ($user) {
                return $survey->isEligible($user) && $survey->is_targeted == true;
            });
        }

        return view('pages/campaigns', compact('campaigns'));
    }

    public function past()
    {
        if (Auth::user()->hasPermissionTo('manage-employees')) {
            $campaigns = Survey::where('publish_status', 'closed')->latest()->paginate(9);
        } else {
            $campaigns = Survey::where('publish_status', '!=', 'draft')->latest()->get();

            $user = Auth::user();

            $campaigns = $campaigns->filter(function ($survey) use ($user) {
                return $survey->entriesFrom($user)->count() > 0;
            });
        }

        return view('pages/campaigns', compact('campaigns'));
    }

    public function viewTemplates()
    {
        $templates = tenancy()->central(function ($tenant) {
            return Template::get();
        });

        return view('pages/templates', compact('templates'));
    }

    public function useTemplate($id)
    {
        $template = tenancy()->central(function ($tenant) use ($id) {
            return Template::findOrFail($id);
        });

        $survey = Survey::create([
            'name' => '',
            'settings' => $template->settings,
            'rationale' => $template->rationale,
            'rationale_description' => '',
            'survey_type' => $template->survey_type,
            'framework_id' => $template->id,
            'start_date' => Carbon::now()->startOfDay()->format('Y-m-d H:i:s'),
            'end_date' => Carbon::now()->addMonth()->endOfDay()->format('Y-m-d H:i:s'),
            'start_time' => '00:00',
            'end_time' => '23:59',
        ]);

        foreach ($template->data as $key => $data) {
            $section = $survey->sections()->create(['name' => $key, 'sort_order' => $data['settings']['sort_order']]);

            foreach ($data as $question => $data) {
                if ($question == 'settings') {
                    continue;
                }

                $section->questions()->create([
                    'content' => $question,
                    'type' => $data['type'],
                    'rules' => $data['rules'],
                    'options' => $data['options'] ?? [],
                    'sort_order' => $data['sort_order'],
                ]);
            }
        }

        return redirect()->route('survey.edit', [$survey]);
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

        return redirect()->back();
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
            // dd($e);
        }


        return redirect()->route('survey.edit', [$survey]);
    }
}
