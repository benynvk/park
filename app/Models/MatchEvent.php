<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MatchEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'team_id',
        'player_id',
        'type',
        'related_player_id',
        'minutes',
    ];

    /**
     * @return BelongsTo
     */
    public function match(): BelongsTo
    {
        return $this->belongsTo(Match::class, 'id', 'team_id');
    }

    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function player(): HasOne
    {
        return $this->hasOne(Player::class, 'id', 'player_id');
    }

    public function related_player(): HasOne
    {
        return $this->hasOne(Player::class, 'id', 'related_player_id');
    }
}
