<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'team_id', 'rp', 'goles', 'ganados', 'perdidos', 'faltas', 'tr', 'ta'
    ];

    public function Team()
    {
        return $this->belongsTo(Team::class);
    }
}
