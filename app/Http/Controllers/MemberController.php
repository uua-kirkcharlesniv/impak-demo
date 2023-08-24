<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;

class MemberController extends Controller
{
    public function indexTabs()
    {
        $members = User::role('employee')->paginate(9);
        return view('pages/community/users-tabs', compact('members'));
    }

    public function indexTiles(Request $request)
    {
        if (in_array($request->segment(2), ['groups'])) {
            $members = Group::paginate(9);
        } else {
            $members = Department::paginate(9);
        }

        return view('pages/community/groups-tiles', compact('members'));
    }
}
