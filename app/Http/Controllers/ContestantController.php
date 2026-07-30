<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Contestant;
use Illuminate\Http\Request;

class ContestantController extends Controller
{
    /**
     * List contestants per contest
     */
    public function index(Contest $contest)
    {
        $contestants = Contestant::where('contest_id', $contest->id)
            ->orderBy('number')
            ->get();

        $maleContestants = Contestant::where('contest_id', $contest->id)
            ->where('gender', 'Male')
            ->orderBy('number')
            ->get();

        $femaleContestants = Contestant::where('contest_id', $contest->id)
            ->where('gender', 'Female')
            ->orderBy('number')
            ->get();

        return view(
            'contestants.index',
            compact(
                'contest',
                'contestants',
                'maleContestants',
                'femaleContestants'
            )
        );
    }

    /**
     * Create form
     */
    public function create(Contest $contest)
    {
        return view(
            'contestants.create',
            compact('contest')
        );
    }

    /**
     * Save contestant
     */
    public function store(Request $request, Contest $contest)
    {
        $request->validate([
            'name' => 'required|max:255',
            'second_name' => 'nullable|max:255',
            'gender' => 'required|in:Male,Female',
            'team_name' => 'nullable|max:255',
        ]);

        $number = $contest->contestants()->count() + 1;

        Contestant::create([
            'contest_id' => $contest->id,
            'number' => $number,
            'name' => $request->name,
            'second_name' => $request->second_name,
            'gender' => $request->gender,
            'team_name' => $request->team_name,
        ]);

        return redirect()
            ->route('contestants.index', $contest->id)
            ->with(
                'success',
                'Contestant added successfully!'
            );
    }

    /**
     * Edit form
     */
    public function edit(
        Contest $contest,
        Contestant $contestant
    ) {
        $contests = Contest::all();

        return view(
            'contestants.edit',
            compact(
                'contest',
                'contestant',
                'contests'
            )
        );
    }

    /**
     * Update contestant
     */
    public function update(
        Request $request,
        Contest $contest,
        Contestant $contestant
    ) {
        $request->validate([
            'name' => 'required|max:255',
            'second_name' => 'nullable|max:255',
            'gender' => 'required|in:Male,Female',
            'team_name' => 'nullable|max:255',
        ]);

        $contestant->update([
            'name' => $request->name,
            'second_name' => $request->second_name,
            'gender' => $request->gender,
            'team_name' => $request->team_name,
        ]);

        return redirect()
            ->route('contestants.index', $contest->id)
            ->with(
                'success',
                'Contestant updated successfully!'
            );
    }

    /**
     * Delete contestant
     */
    public function destroy(
        Contest $contest,
        Contestant $contestant
    ) {
        $contestant->delete();

        return redirect()
            ->route('contestants.index', $contest->id)
            ->with(
                'success',
                'Contestant deleted successfully!'
            );
    }
}