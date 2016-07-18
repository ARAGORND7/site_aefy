<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ForumSubCategorie extends Model
{

    /**
     * Match the Eloquent Model and the table name
     * @var string
     */
    protected $table = 'forum_subcategories';

    protected $fillable = ['name', 'forum_category_id', 'order', 'is_locked'];

    public function category()
    {
        return $this->belongsTo('App\ForumCategories', 'forum_category_id');
    }

    public function topicAssociated()
    {
        return $this->hasMany('App\ForumTopic', 'forum_subcategory_id');
    }

    public function topics()
    {
        return ForumTopic::where(['forum_subcategory_id' => $this->id])->orderBy('created_at', 'DESC')->paginate(20);
    }

    public function getStickTopics()
    {
        return ForumTopic::where(['is_sticky' => true], ['forum_subcategory_id' => $this->id])->get();
    }

    public function getLastMessage()
    {
        return ForumMessage::join('forum_topic', 'forum_topic.id', '=', 'forum_messages.forum_topic_id')
            ->where('forum_subcategory_id', '=', $this->id)
            ->orderBy('forum_messages.created_at', 'desc')
            ->first();

    }
}
