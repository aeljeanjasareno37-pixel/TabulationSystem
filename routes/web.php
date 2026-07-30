<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ExposureController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\JudgePortalController;
use App\Http\Controllers\ScoreController;

use App\Models\Exposure;
use App\Models\Score;


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', function(){

    return redirect()->route('dashboard');

});


Route::get('/dashboard',
    [DashboardController::class,'index']
)->name('dashboard');



/*
|--------------------------------------------------------------------------
| Contest Management
|--------------------------------------------------------------------------
*/

Route::resource('contests',ContestController::class);



Route::get('/contests/{contest}/settings',
    [ContestController::class,'settings']
)->name('contests.settings');


Route::post('/contests/{contest}/activate',
    [ContestController::class,'activate']
)->name('contests.activate');


Route::post('/contests/{contest}/complete',
    [ContestController::class,'complete']
)->name('contests.complete');



Route::get('/contests/{contest}/tabulate',
    [ContestController::class,'tabulate']
)->name('contests.tabulate');



Route::get('/contests/{contest}/results',
    [ContestController::class,'results']
)->name('contests.results');



Route::get('/contests/{contest}/rankings',
    [ContestController::class,'rankings']
)->name('contests.rankings');




/*
|--------------------------------------------------------------------------
| Print Reports
|--------------------------------------------------------------------------
*/


Route::get('/contests/{contest}/print-scores',
    [ContestController::class,'printScores']
)->name('contests.print.scores');



Route::get('/contests/{contest}/print-results',
    [ContestController::class,'printResults']
)->name('contests.print.results');



Route::get('/contests/{contest}/print-rankings',
    [ContestController::class,'printRankings']
)->name('contests.print.rankings');






/*
|--------------------------------------------------------------------------
| Contestants
|--------------------------------------------------------------------------
*/


Route::prefix('contests/{contest}/contestants')
->group(function(){


    Route::get('/',
        [ContestantController::class,'index']
    )->name('contestants.index');



    Route::get('/create',
        [ContestantController::class,'create']
    )->name('contestants.create');



    Route::post('/',
        [ContestantController::class,'store']
    )->name('contestants.store');



    Route::get('/{contestant}/edit',
        [ContestantController::class,'edit']
    )->name('contestants.edit');



    Route::put('/{contestant}',
        [ContestantController::class,'update']
    )->name('contestants.update');



    Route::delete('/{contestant}',
        [ContestantController::class,'destroy']
    )->name('contestants.destroy');


});







/*
|--------------------------------------------------------------------------
| Exposure Management
|--------------------------------------------------------------------------
*/


Route::prefix('contests/{contest}/exposures')
->group(function(){



    Route::get('/',
        [ExposureController::class,'index']
    )->name('exposures.index');



    Route::get('/create',
        [ExposureController::class,'create']
    )->name('exposures.create');



    Route::post('/',
        [ExposureController::class,'store']
    )->name('exposures.store');



    Route::get('/{exposure}/edit',
        [ExposureController::class,'edit']
    )->name('exposures.edit');



    Route::put('/{exposure}',
        [ExposureController::class,'update']
    )->name('exposures.update');



    Route::delete('/{exposure}',
        [ExposureController::class,'destroy']
    )->name('exposures.destroy');



    Route::post('/{exposure}/lock',
        [ExposureController::class,'lock']
    )->name('exposures.lock');



    Route::post('/{exposure}/unlock',
        [ExposureController::class,'unlock']
    )->name('exposures.unlock');



});







/*
|--------------------------------------------------------------------------
| Criteria
|--------------------------------------------------------------------------
*/


Route::prefix('contests/{contest}/exposures/{exposure}/criteria')
->group(function(){


    Route::get('/',
        [CriteriaController::class,'index']
    )->name('criteria.index');



    Route::get('/create',
        [CriteriaController::class,'create']
    )->name('criteria.create');



    Route::post('/',
        [CriteriaController::class,'store']
    )->name('criteria.store');



    Route::get('/{criteria}/edit',
        [CriteriaController::class,'edit']
    )->name('criteria.edit');



    Route::put('/{criteria}',
        [CriteriaController::class,'update']
    )->name('criteria.update');



    Route::delete('/{criteria}',
        [CriteriaController::class,'destroy']
    )->name('criteria.destroy');


});








/*
|--------------------------------------------------------------------------
| Judges
|--------------------------------------------------------------------------
*/


Route::prefix('contests/{contest}/judges')
->group(function(){



    Route::get('/',
        [JudgeController::class,'index']
    )->name('judges.index');



    Route::get('/create',
        [JudgeController::class,'create']
    )->name('judges.create');



    Route::post('/',
        [JudgeController::class,'store']
    )->name('judges.store');



    Route::get('/{judge}/edit',
        [JudgeController::class,'edit']
    )->name('judges.edit');



    Route::put('/{judge}',
        [JudgeController::class,'update']
    )->name('judges.update');



    Route::delete('/{judge}',
        [JudgeController::class,'destroy']
    )->name('judges.destroy');



});








/*
|--------------------------------------------------------------------------
| Judge Portal
|--------------------------------------------------------------------------
*/


Route::get('/judge',
    [JudgePortalController::class,'loginForm']
)->name('judge.login');



Route::post('/judge/login',
    [JudgePortalController::class,'login']
)->name('judge.authenticate');



Route::get('/judge/dashboard',
    [JudgePortalController::class,'dashboard']
)->name('judge.dashboard');



Route::post('/judge/logout',
    [JudgePortalController::class,'logout']
)->name('judge.logout');








/*
|--------------------------------------------------------------------------
| Score Entry
|--------------------------------------------------------------------------
*/


Route::get('/judge/score/{exposure}',
    [ScoreController::class,'create']
)->name('scores.create');



Route::post('/judge/score',
    [ScoreController::class,'store']
)->name('scores.store');







/*
|--------------------------------------------------------------------------
| DEBUG ROUTES
|--------------------------------------------------------------------------
| Temporary testing only
|--------------------------------------------------------------------------
*/



Route::get('/debug-casual',function(){


    $scores = Score::where('exposure_id',2)
        ->get();



    return $scores;


});




Route::get('/debug-criteria',function(){


    $exposures = Exposure::with('criteria')
        ->where('contest_id',3)
        ->orderBy('order')
        ->get();



    return $exposures;


});