<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumMessage extends Model
{

    protected $fillable = ['content', 'user_id', 'forum_topic_id'];
    /**
     * Match the Eloquent Model and the table name
     * @var string
     */
    protected $table = 'forum_messages';

    public function topic()
    {
        return $this->belongsTo('App\ForumTopic');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
