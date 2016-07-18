<?php

namespace App\Http\Controllers\Admin;

use App\ForumMessage;
use App\ForumSubCategorie;
use App\ForumCategories;
use App\ForumTopic;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic;

class ForumSubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Administration';
        $forum_categories = ForumCategories::lists('name', 'id');
        return view('forum.subcategories.add', compact('page_title', 'forum_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'min:2|unique:forum_subcategories,name|required',
            'forum_category_id' => 'required'
        ]);
        ForumSubCategorie::create($request->all());
        return redirect(route('forum.order'))->with('success', 'La sous-catégorie a bien été ajouté');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ForumSubCategorie::findOrFail($id);
        $forum_categories = ForumCategories::lists('name', 'id');
        $page_title = 'Editer une catégorie';
        return view('forum.subcategories.edit', compact('category', 'forum_categories', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = ForumSubCategorie::findOrFail($id);
        $this->validate($request, [
            'name' => "min:2|unique:forum_categories,name, {$category->id}|required",
        ]);
        if (!$request->is_locked){
            $request->merge(['is_locked' => false]);
        }
        $category->update($request->all());
        return redirect()->back()->with('success', 'La sous-catégorie a bien été modifié ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ForumSubCategorie::findOrFail($id);
        $topic = ForumTopic::where('forum_subcategory_id', '=', $category->id)->get();
        foreach($topic as $t){
            $message = ForumMessage::where('forum_topic_id','=', $t->id)->get();
            foreach($message as $m){
                $m->delete();
            }
            $t->delete();
        }
        $category->delete();
        return redirect(route('forum.categories.order'))->with('success', 'La sous-catégorie a bien été supprimé!');
    }

    public function order($id){
        $category = ForumCategories::findOrFail($id);
        $page_title = 'Ordonner la catégorie';
        return view('forum.subcategories.order', compact('category', 'page_title'));
    }

    public function storeOrder($id, Request $request){
        $category = ForumCategories::findOrFail($id);
        foreach ($category->subcategory as $s){
            $input = Input::get($s->id);
            $s->update(['order' => $input]);
        }

        return back()->with('success', "L'ordre a bien été modifié !");
    }
}
