<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = array('title', 'content', 'picturePath', 'online', 'newscategory_id');

    public function scopePublished($query){
        return $query->where('online', true);
    }

    public function newsCategory(){
        return $this->belongsTo('App\NewsCategory');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
