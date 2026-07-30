<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    protected $fillable = [
        'contest_id',
        'number',
        'name',
        'gender',
        'second_name',
        'team_name',
        'contestant_number',
        'category',
        'is_active',
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