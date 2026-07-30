<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    protected $fillable = [
        'contest_id',
        'name',
        'access_code',
    ];

    /**
     * Contest
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    /**
     * Scores
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}