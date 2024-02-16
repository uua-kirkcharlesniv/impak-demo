<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
use App\Models\Invite;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function invitedPage(Request $request)
    {
        $invited = Invite::orderBy('status', 'DESC')->get();

        return view('pages/community/users-tabs', compact('invited'));
    }

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

    public function deleteGroup($id)
    {
        if (!Auth::user()->hasPermissionTo('manage-groups')) {
            abort(401);
        }

        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->route('community.groups.list');
    }

    public function deleteDepartment($id)
    {
        if (!Auth::user()->hasPermissionTo('manage-departments')) {
            abort(401);
        }

        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('community.departments.list');
    }
}
