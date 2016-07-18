<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumSignaledMessage extends Model
{
    /**
     * Match the Eloquent Model and the table name
     * @var string
     */
    protected $table = 'forum_signaled_messages';

    protected $fillable = ['forum_message_id'];
}
