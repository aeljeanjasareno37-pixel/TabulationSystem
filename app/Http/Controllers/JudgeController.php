<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Judge;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JudgeController extends Controller
{
    /**
     * Display all judges for a contest.
     */
    public function index(Contest $contest)
    {
        $judges = $contest->judges()->get();

        return view('judges.index', compact('contest', 'judges'));
    }

    /**
     * Show create form.
     */
    public function create(Contest $contest)
    {
        return view('judges.create', compact('contest'));
    }

    /**
     * Store a new judge.
     */
    public function store(Request $request, Contest $contest)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Generate unique access code
        do {
            $accessCode = 'JDG-' . strtoupper(Str::random(5));
        } while (Judge::where('access_code', $accessCode)->exists());

        Judge::create([
            'contest_id' => $contest->id,
            'name' => $request->name,
            'access_code' => $accessCode,
        ]);

        return redirect()
            ->route('judges.index', $contest->id)
            ->with('success', 'Judge added successfully.');
    }

    /**
     * Edit judge.
     */
    public function edit(Contest $contest, Judge $judge)
    {
        return view('judges.edit', compact('contest', 'judge'));
    }

    /**
     * Update judge.
     */
    public function update(Request $request, Contest $contest, Judge $judge)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $judge->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('judges.index', $contest->id)
            ->with('success', 'Judge updated successfully.');
    }

    /**
     * Delete judge.
     */
    public function destroy(Contest $contest, Judge $judge)
    {
        $judge->delete();

        return redirect()
            ->route('judges.index', $contest->id)
            ->with('success', 'Judge deleted successfully.');
    }
}