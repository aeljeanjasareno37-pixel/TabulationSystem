<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exposure extends Model
{

    protected $fillable = [

        'contest_id',

        'name',

        'order',

        'is_final',

        'carry_over_percentage',

        'top_n',

        'is_locked',

    ];



    protected $casts = [

        'is_final' => 'boolean',

        'is_locked' => 'boolean',

        'carry_over_percentage' => 'decimal:2',

        'order' => 'integer',

        'top_n' => 'integer',

    ];




    /**
     * Exposure belongs to Contest
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }





    /**
     * Exposure has many Criteria
     */
    public function criteria()
    {
        return $this->hasMany(Criteria::class)
            ->orderBy('sort_order');
    }





    /**
     * Exposure has many Scores
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

}