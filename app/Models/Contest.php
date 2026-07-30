<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{

    protected $fillable = [

        'name',

        'description',

        'contest_type',

        'judge_count',

        'contestant_count',

        'tabulator_name',

        'logo',

        'pageant_logo',

        'is_active',

        'is_completed',

    ];



    protected $casts = [

        'is_active' => 'boolean',

        'is_completed' => 'boolean',

    ];



    /**
     * Contestants
     */
    public function contestants()
    {
        return $this->hasMany(Contestant::class);
    }



    /**
     * Exposures
     */
    public function exposures()
    {
        return $this->hasMany(Exposure::class)
            ->orderBy('order');
    }



    /**
     * Criteria
     */
    public function criteria()
    {
        return $this->hasMany(Criteria::class);
    }



    /**
     * Judges
     */
    public function judges()
    {
        return $this->hasMany(Judge::class);
    }



    /**
     * Scores
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }


}