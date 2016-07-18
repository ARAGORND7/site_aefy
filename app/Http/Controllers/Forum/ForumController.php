<?php

namespace App\Http\Controllers\Forum;

use App\ForumCategories;
use App\ForumMessage;
use App\ForumSubCategorie;

use App\ForumTopic;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function index()
    {

        if (!Auth::guest() && Auth::user()->hasPermissionTo('Accéder au forum caché')) {
            $categories = ForumCategories::orderBy('order')->get();
            $subCategories = ForumSubCategorie::all();
        } else {
            $categories = ForumCategories::where('is_hidden', false)->orderBy('order')->get();
        }
        $page_title = "Forum";
        return view('forum.index', compact('page_title', 'categories', 'subCategories'));
    }

    public function subcategory($subcategory)
    {
        $subCateg = ForumSubCategorie::findOrFail($subcategory);
        $topicSticky = ForumTopic::join(\DB::raw('(select max(updated_at) as last_updated, forum_topic_id from forum_messages group by forum_topic_id) ft'), function ($q) {
            $q->on('ft.forum_topic_id', '=', 'forum_topic.id');
        })->orderBy(\DB::raw('ft.last_updated'), 'desc')->where([['forum_topic.is_sticky', '=', true], ['forum_topic.forum_subcategory_id', '=', $subCateg->id]])->get();

        $topicUnsticky = ForumTopic::join(\DB::raw('(select max(updated_at) as last_updated, forum_topic_id from forum_messages group by forum_topic_id) ft'), function ($q) {
            $q->on('ft.forum_topic_id', '=', 'forum_topic.id');
        })->orderBy(\DB::raw('ft.last_updated'), 'desc')->where([['forum_topic.is_sticky', '=', false], ['forum_topic.forum_subcategory_id', '=', $subCateg->id]])->get();
        $page_title = $subCateg->name;
        return view('forum.subcategory', compact('subCateg', 'page_title', 'topicSticky', 'topicUnsticky'));
    }

    public function order(){

        $categories = ForumCategories::orderBy('order')->get();
        $subCategories = ForumSubCategorie::all();
        $page_title = "Réorganiser le forum";
        return view('forum.order', compact('categories', 'subCategories', 'page_title'));
    }
}
