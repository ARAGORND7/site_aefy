<?php

namespace App\Http\Controllers\Admin;

use App\ForumMessage;
use App\ForumTopic;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ForumMessageController extends Controller
{
    public function open($topic_id){
        $topic = ForumTopic::findOrFail($topic_id);
        $topic->update(['is_opened' => true ]);
        return redirect()->back()->with('success', 'Topic ouvert');
    }

    public function close($topic_id){
        $topic = ForumTopic::findOrFail($topic_id);
        $topic->update(['is_opened' => false]);
        return redirect()->back()->with('success', 'Topic fermé');
    }

    public function moderate($message_id){
        $message = ForumMessage::findOrFail($message_id);
        $message->is_moderated = true;
        $message->save();
        DB::table('forum_signaled_messages')->where('forum_message_id', $message->id)->delete();
        return redirect()->back()->with('success', 'Le message a été modéré');
    }

    public function unmoderate($message_id){
        $message = ForumMessage::findOrFail($message_id);
        $message->is_moderated = false;
        $message->save();
        return redirect()->back()->with('success', 'Ce message n\'est plus modéré.');
    }
}