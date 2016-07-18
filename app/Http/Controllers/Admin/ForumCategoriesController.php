<?php

namespace App\Http\Controllers\Admin;

use App\ForumCategories;
use App\ForumMessage;
use App\ForumSubCategorie;
use App\ForumTopic;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class ForumCategoriesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Administration';
        return view('forum.categories.add', compact('page_title'));
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
            'name' => 'min:2|unique:forum_categories,name|required',
            'description' => 'required',
            'picture' => 'required|image'
        ]);
        if ($request->is_hidden === null) {
            $request->merge(['is_hidden' => false]);
        }
        $categ = ForumCategories::create($request->only('name', 'description', 'is_hidden'));
        ImageManagerStatic::make($request->picture)->save(public_path() . "/img/forum_categories/" . $categ->id . ".jpg");
        return redirect(route('forum.categories.order'))->with('success', 'La catégorie a bien été ajouté');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ForumCategories::findOrFail($id);
        $page_title = 'Editer une catégorie';
        return view('forum.categories.edit', compact('category', 'page_title'));
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
        $category = ForumCategories::findOrFail($id);
        $this->validate($request, [
            'name' => "min:2|unique:forum_categories,name, {$category->id}|required",
            'picture' => 'image'
        ]);
        $category->update($request->all());
        if (is_object($request->picture) && $request->picture->isValid()) {
            ImageManagerStatic::make($request->picture)->save(public_path() . "/img/forum_categories/" . $category->id . ".jpg");
        }
        return redirect()->back()->with('success', 'La catégorie a bien été modifié ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ForumCategories::findOrFail($id);
        $subcategories = ForumSubCategorie::where('forum_category_id', '=', $category->id)->get();
        foreach ($subcategories as $s) {
            $topic = ForumTopic::where('forum_subcategory_id', '=', $s->id)->get();
            foreach ($topic as $t) {
                $message = ForumMessage::where('forum_topic_id', '=', $t->id)->get();
                foreach ($message as $m) {
                    $m->delete();
                }
                $t->delete();
            }
            $s->delete();
        }
        $category->delete();


        $file = public_path('img/forum_categories/' . $category->id . '.jpg');
        unlink($file);
        return back()->with('success', 'La catégorie a bien été supprimé !');
    }

    public function order()
    {
        $categories = ForumCategories::orderBy('order')->get();
        $page_title = 'Ordonner les catégories';
        return view('forum.categories.order', compact('page_title', 'categories'));
    }

    public function storeOrder(Request $request)
    {
        $categories = ForumCategories::all();
        foreach ($categories as $c){
            $input = Input::get($c->id);
            $c->update(['order' => $input]);
        }

        return back()->with('success', "L'ordre a bien été modifié !");
    }
}
