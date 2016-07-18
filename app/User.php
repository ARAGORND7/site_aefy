<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Iatstuti\Database\Support\NullableFields;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use NullableFields;
    use hasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'email', 'password', 'remember_token',
        'last_name', 'first_name', 'gender', 'date_of_birth',
        'country', 'city', 'game', 'avatar', 'signature'
    ];

    protected $nullable = [
        'last_name', 'first_name', 'gender', 'date_of_birth',
        'country', 'city', 'game', 'signature'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topics()
    {
        return $this->hasMany('App\ForumTopic');
    }

    public function messages()
    {
        return $this->hasMany('App\ForumMessage');
    }

    public function news()
    {
        return $this->hasMany('App\News');
    }

    public function banCreator()
    {
        return $this->hasMany('App\UserBan', 'creator');
    }

    public function banned()
    {
        return $this->hasMany('App\UserBan', 'user_id');
    }

    /**
     * Get the User's Date Of Birth
     *
     * @param  string $value
     * @return string
     */
    public function getDateOfBirthAttribute($value)
    {
        if ($value == null) {
            return null;
        } else {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function getAvatarAttribute($avatar)
    {
        if ($avatar) {
            return "/img/avatars/{$this->id}.jpg";
        }
        return false;
    }

    public function setAvatarAttribute($avatar)
    {
        if (is_object($avatar) && $avatar->isValid()) {
            ImageManagerStatic::make($avatar)->fit(150, 150)->save(public_path() . "/img/avatars/" . Auth::user()->id . ".jpg");
            $this->attributes['avatar'] = true;
        }
    }
}
