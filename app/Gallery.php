<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function latestPhoto()
    {
        return $this->hasOne(Photo::class)->latest();
    }

    public function getPhoto($id)
    {
        return $this->hasOne(Photo::class)->find($id);
    }

    public static function categories()
    {
        return static::has('latestPhoto')->with('latestPhoto');
    }

    public function getRouteKeyName()
    {
        return 'name_slug';
    }
}
