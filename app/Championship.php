<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    protected $fillable = [
        'title', 'body', 'court_id', 'user_id', 'cost', 'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($shampionship){
            $shampionship->photoos->each->delete();
            $shampionship->teams->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function photoos()
    {
        return $this->hasMany(Photoo::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query){
        $query->with(['owner', 'court', 'photoos'])->whereNotNull('court_id');
    }

    public function scopeAllowed($query)
    {
        if( auth()->user()->can('view', $this))
        {
            return $query;
        }
        return $query->where('user_id', auth()->id());
    }

    public function isPublished(){
        return ! is_null($this->court_id);
    }

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();

        $shampionship = static::query()->create($attributes);

        $shampionship->generateUrl();

        return $shampionship;
    }

    public function generateUrl()
    {
        $url = str_slug($this->title);

        if ($this->whereUrl($url)->exists())
        {
            $url = "{$url}-{$this->id}";
        }

        $this->url = $url;

        $this->save();
    }

    // para mostrar si uun campeonato no tiene fotos o tiene mucha o tiene una sola
    public function viewType()
    {
        if ($this->photoos->count() === 1):
            return 'championships.photoo';
        elseif($this->photoos->count() > 1):
            return 'championships.carousel';
        else:
            return 'championships.text';
        endif;
    }

}
