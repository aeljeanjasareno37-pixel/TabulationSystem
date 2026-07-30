<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;


    protected $table = 'criterias';



    protected $fillable = [

        'contest_id',

        'exposure_id',

        'name',

        'percentage',

        'minimum_score',

        'maximum_score',

        'sort_order',

        'is_active',

    ];



    protected $casts = [

        'percentage' => 'decimal:2',

        'minimum_score' => 'decimal:2',

        'maximum_score' => 'decimal:2',

        'sort_order' => 'integer',

        'is_active' => 'boolean',

    ];




    /**
     * Criteria belongs to Contest
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }





    /**
     * Criteria belongs to Exposure
     */
    public function exposure()
    {
        return $this->belongsTo(Exposure::class);
    }





    /**
     * Criteria has many Scores
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

}