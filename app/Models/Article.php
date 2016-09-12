<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function getTags()
    {
        return $this->belongsToMany('App\Models\Tags')->withTimestamps();
    }

}
