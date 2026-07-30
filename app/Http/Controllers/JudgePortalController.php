<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use App\Models\Score;
use Illuminate\Http\Request;

class JudgePortalController extends Controller
{
    /**
     * Show Judge Login Page
     */
    public function loginForm()
    {
        return view('judge.login');
    }

    /**
     * Authenticate Judge
     */
    public function login(Request $request)
    {
        $request->validate([
            'access_code' => 'required'
        ]);

        $judge = Judge::with('contest')
            ->where('access_code', $request->access_code)
            ->first();

        if (!$judge) {
            return back()->with(
                'error',
                'Invalid access code.'
            );
        }

        if (!$judge->contest || !$judge->contest->is_active) {
            return back()->with(
                'error',
                'This contest is not active yet.'
            );
        }

        session([
            'judge_id'   => $judge->id,
            'judge_name' => $judge->name,
            'contest_id' => $judge->contest_id,
        ]);

        return redirect()->route('judge.dashboard');
    }

    /**
     * Judge Dashboard
     */
    public function dashboard()
    {
                if (!session()->has('judge_id')) {
            return redirect()->route('judge.login');
        }

        $judge = Judge::with([
            'contest',
            'contest.exposures.criteria',
            'contest.contestants'
        ])->findOrFail(session('judge_id'));

        $contest = $judge->contest;

        /*
        |--------------------------------------------------------------------------
        | Contest Finished
        |--------------------------------------------------------------------------
        */
        if ($contest->is_completed) {

            return view(
                'judge.dashboard',
                [
                    'judge' => $judge,
                    'contestFinished' => true,
                    'exposures' => collect()
                ]
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Load Exposures
        |--------------------------------------------------------------------------
        */

        $exposures = $contest->exposures()
            ->orderBy('order')
            ->get();

        $currentOpen = null;

        foreach ($exposures as $exposure) {

            $criteriaCount = $exposure->criteria()
                ->where('is_active', true)
                ->count();

            $contestantCount = $contest->contestants()
                ->where('is_active', 1)
                ->count();

            $expectedScore = $criteriaCount * $contestantCount;

            $submittedScore = Score::where('judge_id', $judge->id)
                ->where('exposure_id', $exposure->id)
                ->count();

            $exposure->completed = (
                $expectedScore > 0 &&
                $submittedScore >= $expectedScore
            );

            if (!$exposure->completed && $currentOpen === null) {

                $currentOpen = $exposure->id;

            }

        }

        /*
        |--------------------------------------------------------------------------
        | Apply Status
        |--------------------------------------------------------------------------
        */

        foreach ($exposures as $exposure) {

            if ($exposure->completed) {

                $exposure->status = 'submitted';

            } elseif ($exposure->id == $currentOpen) {

                $exposure->status = 'open';

            } else {

                $exposure->status = 'locked';

            }

        }

        return view(
            'judge.dashboard',
            compact(
                'judge',
                'exposures'
            )
        );
            /**
     * Logout Judge
     */
    }
    public function logout()
    {
        session()->forget([
            'judge_id',
            'judge_name',
            'contest_id'
        ]);

        return redirect()
            ->route('judge.login');
    }
}