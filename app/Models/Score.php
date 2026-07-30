<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'contest_id',
        'exposure_id',
        'contestant_id',
        'judge_id',
        'criteria_id',
        'score',
    ];

    protected $casts = [
        'score' => 'decimal:2',
    ];

    /**
     * Contest
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    /**
     * Exposure
     */
    public function exposure()
    {
        return $this->belongsTo(Exposure::class);
    }

    /**
     * Contestant
     */
    public function contestant()
    {
        return $this->belongsTo(Contestant::class);
    }

    /**
     * Judge
     */
    public function judge()
    {
        return $this->belongsTo(Judge::class);
    }

    /**
     * Criteria
     */
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}