<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Match extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_id',
        'team2_id',
        'stadium_id',
        'league_id',
        'team1_score',
        'team2_score',
        'time',
    ];

    /**
     * @return HasOne
     */
    public function team1(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team1_id');
    }

    /**
     * @return HasOne
     */
    public function team2(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team2_id');
    }

    /**
     * @return HasOne
     */
    public function league(): HasOne
    {
        return $this->hasOne(League::class, 'id', 'league_id');
    }

    /**
     * @return HasOne
     */
    public function stadium(): HasOne
    {
        return $this->hasOne(Stadium::class, 'id', 'stadium_id');
    }

}
