<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorCategory extends Model
{
    protected $table = 'sponsor_category';

    protected $fillable = ['label'];

    public function sponsor()
    {
        return $this->hasMany('App\Sponsor');
    }
}
