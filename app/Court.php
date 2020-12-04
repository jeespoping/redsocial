<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class court extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'user_id', 'cost'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($court){
            $court->photos->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query){
        $query->with(['owner', 'category', 'photos'])->whereNotNull('body');
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
        return ! is_null($this->body);
    }

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();

        $court = static::query()->create($attributes);

        $court->generateUrl();

        return $court;
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

    // para no sobreeescribir categorias ya creadas
    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category)
            ? $category
            : Category::create(['name' => $category])->id;
    }

    // para mostrar si uuna cancha no tiene fotos o tiene mucha o tiene una sola
    public function viewType()
    {
        if ($this->photos->count() === 1):
            return 'courts.photo';
        elseif($this->photos->count() > 1):
            return 'courts.carousel';
        else:
            return 'courts.text';
        endif;
    }
}
