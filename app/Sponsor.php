<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    // DB table name of the Model
    protected $table = 'sponsor';

    protected $fillable = [
        'name', 'url','description', 'picture', 'sponsor_category'
    ];

    public function getPictureAttribute($picture){
        if($picture){
            return "/img/sponsor/{$this->id}.jpg";
        }
        return false;
    }

    public function setPictureAttribute($picture){
        if(is_object($picture) && $picture->isValid()){
            $this->attributes['picture'] = true;
        }
    }

    public function category(){
        return $this->belongsTo('App\SponsorCategory', 'sponsor_category');
    }
}
