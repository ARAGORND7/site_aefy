<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic;

class ForumCategories extends Model
{
    /**
     * Match the Eloquent Model and the table name
     * @var string
     */
    protected $table = 'forum_categories';

    protected $fillable = ['name', 'picture','description', 'is_hidden', 'order'];

    public function subcategory()
    {
        return $this->hasMany('App\ForumSubCategorie', 'forum_category_id');
    }

    public function getSubCateg(){
        return ForumSubCategorie::where('forum_category_id', $this->id)->orderBy('order')->get();
    }

    public function getPictureAttribute(){
            return "/img/forum_categories/".$this->id.".jpg";

    }

    public function setPictureAttribute($picture){
        if(is_object($picture) && $picture->isValid()){
            ImageManagerStatic::make($picture)->save(public_path() . "/img/forum_categories/".$this->id.".jpg");
        }else{
            dd('non ok');
        }
    }

    public function isHidden(){
        if ($this->is_hidden == true){
            return true;
        }else{
            return false;
        }
    }
}
