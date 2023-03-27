<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::paginate(9);
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
        return view('pages/campaign/create');
    }
}
