<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Criteria;
use App\Models\Exposure;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{

    /**
     * Display criteria for a specific exposure.
     */
    public function index(Contest $contest, Exposure $exposure)
    {

        $criteria = $exposure->criteria()
            ->orderBy('sort_order')
            ->get();


        return view('criteria.index', compact(
            'contest',
            'exposure',
            'criteria'
        ));

    }




    /**
     * Show create form.
     */
    public function create(Contest $contest, Exposure $exposure)
    {

        return view('criteria.create', compact(
            'contest',
            'exposure'
        ));

    }





    /**
     * Store criteria.
     */
    public function store(
        Request $request,
        Contest $contest,
        Exposure $exposure
    )
    {

        $request->validate([

            'name' => 'required|max:255',

            'percentage' => 'required|numeric|min:0|max:100',

            'minimum_score' => 'required|numeric|min:0',

            'maximum_score' => 'required|numeric|min:0|gte:minimum_score',

            'sort_order' => 'nullable|integer|min:0',

        ]);




        Criteria::create([

            // required dahil nasa database mo ito
            'contest_id' => $contest->id,

            'exposure_id' => $exposure->id,

            'name' => $request->name,

            'percentage' => $request->percentage,

            'minimum_score' => $request->minimum_score,

            'maximum_score' => $request->maximum_score,

            'sort_order' => $request->sort_order ?? 0,

            'is_active' => true,

        ]);





        return redirect()

            ->route('criteria.index', [
                $contest->id,
                $exposure->id
            ])

            ->with(
                'success',
                'Criteria added successfully.'
            );

    }





    /**
     * Show edit form.
     */
    public function edit(
        Contest $contest,
        Exposure $exposure,
        Criteria $criteria
    )
    {

        return view('criteria.edit', compact(
            'contest',
            'exposure',
            'criteria'
        ));

    }





    /**
     * Update criteria.
     */
    public function update(
        Request $request,
        Contest $contest,
        Exposure $exposure,
        Criteria $criteria
    )
    {

        $request->validate([

            'name' => 'required|max:255',

            'percentage' => 'required|numeric|min:0|max:100',

            'minimum_score' => 'required|numeric|min:0',

            'maximum_score' => 'required|numeric|min:0|gte:minimum_score',

            'sort_order' => 'nullable|integer|min:0',

        ]);





        $criteria->update([

            'name' => $request->name,

            'percentage' => $request->percentage,

            'minimum_score' => $request->minimum_score,

            'maximum_score' => $request->maximum_score,

            'sort_order' => $request->sort_order ?? 0,

        ]);






        return redirect()

            ->route('criteria.index', [
                $contest->id,
                $exposure->id
            ])

            ->with(
                'success',
                'Criteria updated successfully.'
            );

    }





    /**
     * Delete criteria.
     */
    public function destroy(
        Contest $contest,
        Exposure $exposure,
        Criteria $criteria
    )
    {

        $criteria->delete();



        return redirect()

            ->route('criteria.index', [
                $contest->id,
                $exposure->id
            ])

            ->with(
                'success',
                'Criteria deleted successfully.'
            );

    }


}