<?php

namespace App\Http\Controllers;

use App\Models\TeamMembers;
use App\Http\Requests\StoreTeamMemberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMembers::latest()->get();
        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(StoreTeamMemberRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        TeamMembers::create($validated);
        return redirect()->route('team.index')->with('success', 'عضو با موفقیت اضافه شد.');
    }


    public function edit(TeamMembers $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMembers $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:team_members,slug,' . $team->id,
            'avatar' => 'nullable|image|max:2048',
            'role' => 'required|string',
            'bio' => 'nullable|string',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'name_en' => 'nullable|string|max:255',
            'slug_en' => 'nullable|string|unique:team_members,slug_en,' . $team->id,
            'role_en' => 'nullable|string|max:255',
            'experience_en' => 'nullable|string|max:255',
            'bio_en' => 'nullable|string',
        ]);

        if ($request->hasFile('avatar')) {
            if ($team->avatar) Storage::disk('public')->delete($team->avatar);
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $team->update($validated);
        return redirect()->route('team.index')->with('success', 'اطلاعات عضو با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(TeamMembers $team)
    {
        if ($team->avatar) Storage::disk('public')->delete($team->avatar);
        $team->delete();
        return redirect()->route('team.index')->with('success', 'عضو با موفقیت حذف شد.');
    }
}
