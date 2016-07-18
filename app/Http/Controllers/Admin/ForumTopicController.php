<?php

namespace App\Http\Controllers\Admin;

use App\ForumSubCategorie;
use App\ForumTopic;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class ForumTopicController extends Controller
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

    public function move(Request $request, $topic_id){
        $subcategory_id = $request->cat;
        $topic  = ForumTopic::findOrFail($topic_id);
        $subcategory = ForumSubCategorie::findOrFail($subcategory_id);
        $topic->update(['forum_subcategory_id' => $subcategory->id]);
        Session::flash('success', 'La catégorie du topic à bien été changé');

    }

    public function delete($topic_id){
        $topic = ForumTopic::findOrFail($topic_id);
        $topic->delete();
        return back()->with('success', 'Le topic a bien été supprimé');
    }

    public function stick($topic_id){
        $topic = ForumTopic::findOrFail($topic_id);
        $topic->update(['is_sticky' => true]);
        return back()->with('success', 'Ce topic est maintenant epinglé');
    }

    public function unstick($topic_id){
        $topic = ForumTopic::findOrFail($topic_id);
        $topic->update(['is_sticky' => false]);
        return back()->with('success', "Ce topic n'est plus epinglé");
    }
}