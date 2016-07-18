<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{

    protected $fillable = ['subject','forum_subcategory_id', 'is_opened', 'is_sticky'];
    /**
     * Match the Eloquent Model and the table name
     * @var string
     */
    protected $table = 'forum_topic';

    public function subcategory()
    {
        return $this->belongsTo('App\ForumSubCategorie', 'forum_subcategory_id');
    }

    public function messages()
    {
        return $this->hasMany('App\ForumMessage');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function countMessage(){
        return ForumMessage::where('forum_topic_id',$this->id)->count();
    }

    public function getLastMessageInfo(){
        return ForumMessage::where('forum_topic_id', $this->id)->orderBy('created_at', 'desc')->first();
    }
}
