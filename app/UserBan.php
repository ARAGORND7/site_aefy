<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBan extends Model
{
    protected $table = 'users_ban';

    protected $fillable = ['user_id', 'creator', 'reason', 'end_date'];

    protected $nullable = ['end_date'];

    public function banCreator()
    {
        return $this->belongsTo('App\User', 'creator');
    }

    public function banned(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
