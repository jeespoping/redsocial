<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model
{
    protected $fillable = [
        'title' , 'description', 'color', 'textColor', 'start', 'end', 'court_id', 'user_id'
    ];

    protected $dates = ['start', 'end'];

    public function court(){
        return $this->belongsTo(Court::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
