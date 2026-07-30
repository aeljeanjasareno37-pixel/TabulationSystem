<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Exposure;
use Illuminate\Http\Request;

class ExposureController extends Controller
{
    /**
     * Display all exposures of a contest.
     */
    public function index(Contest $contest)
    {
        $exposures = $contest->exposures()
            ->orderBy('order')
            ->get();

        return view('exposures.index', compact('contest', 'exposures'));
    }

    /**
     * Show form to create exposure.
     */
    public function create(Contest $contest)
    {
        return view('exposures.create', compact('contest'));
    }

    /**
     * Store exposure.
     */
    public function store(Request $request, Contest $contest)
    {
        $request->merge([
            'is_final' => $request->boolean('is_final'),
        ]);

        $request->validate([
            'name' => 'required|max:255',
            'order' => 'required|integer|min:1',
            'is_final' => 'boolean',
            'carry_over_percentage' => 'nullable|numeric|min:0|max:100',
            'top_n' => 'nullable|integer|min:1',
        ]);

        Exposure::create([
            'contest_id' => $contest->id,
            'name' => $request->name,
            'order' => $request->order,
            'is_final' => $request->boolean('is_final'),
            'carry_over_percentage' => $request->carry_over_percentage ?? 0,
            'top_n' => $request->top_n,
            'is_locked' => false,
        ]);

        return redirect()
            ->route('exposures.index', $contest->id)
            ->with('success', 'Exposure added successfully.');
    }

    /**
     * Display a single exposure.
     */
    public function show(Contest $contest, Exposure $exposure)
    {
        return view('exposures.show', compact('contest', 'exposure'));
    }

    /**
     * Show edit form.
     */
    public function edit(Contest $contest, Exposure $exposure)
    {
        return view('exposures.edit', compact('contest', 'exposure'));
    }

    /**
     * Update exposure.
     */
    public function update(Request $request, Contest $contest, Exposure $exposure)
    {
        $request->merge([
            'is_final' => $request->boolean('is_final'),
        ]);

        $request->validate([
            'name' => 'required|max:255',
            'order' => 'required|integer|min:1',
            'is_final' => 'boolean',
            'carry_over_percentage' => 'nullable|numeric|min:0|max:100',
            'top_n' => 'nullable|integer|min:1',
        ]);

        $exposure->update([
            'name' => $request->name,
            'order' => $request->order,
            'is_final' => $request->boolean('is_final'),
            'carry_over_percentage' => $request->carry_over_percentage ?? 0,
            'top_n' => $request->top_n,
        ]);

        return redirect()
            ->route('exposures.index', $contest->id)
            ->with('success', 'Exposure updated successfully.');
    }

    /**
     * Delete exposure.
     */
    public function destroy(Contest $contest, Exposure $exposure)
    {
        $exposure->delete();

        return redirect()
            ->route('exposures.index', $contest->id)
            ->with('success', 'Exposure deleted successfully.');
    }

    /**
     * Lock Exposure
     */
    public function lock($contest, $exposure)
    {
        $contest = Contest::findOrFail($contest);

        $currentExposure = Exposure::where('contest_id', $contest->id)
            ->findOrFail($exposure);

        $currentExposure->update([
            'is_locked' => true,
        ]);

        $nextExposure = Exposure::where('contest_id', $contest->id)
            ->where('order', '>', $currentExposure->order)
            ->orderBy('order')
            ->first();

        if ($nextExposure) {
            $nextExposure->update([
                'is_locked' => false,
            ]);
        }

        return back()->with(
            'success',
            'Exposure locked successfully!'
        );
    }

    /**
     * Unlock Exposure
     */
    public function unlock($contest, $exposure)
    {
        $contest = Contest::findOrFail($contest);

        $currentExposure = Exposure::where('contest_id', $contest->id)
            ->findOrFail($exposure);

        $currentExposure->update([
            'is_locked' => false,
        ]);

        return back()->with(
            'success',
            'Exposure unlocked successfully!'
        );
    }
}