<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * Set timestamps off
     */
     public $timestamps = false;

     /**
      * Get users with a certain role
      */
     public function users()
     {
         return $this->belongsToMany('User', 'users_roles');
     }
}
