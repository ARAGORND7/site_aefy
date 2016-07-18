<?php

namespace App\Http\Controllers;

use App\Sponsor;
use App\SponsorCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\ImageManagerStatic;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::paginate(10);
        $page_title = "Nos sponsors & partenaires";
        return view('sponsor.index', compact('sponsors', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $page_title = 'Ajouter un sponsor';
        $categories = SponsorCategory::lists('label', 'id');
        return view('sponsor.add', compact('page_title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|min:2|unique:sponsor',
            'url'         => 'required|min:2|url',
            'description' => 'required',
            'picture'     => 'required|image',
        ]);
        $sponsor = Sponsor::create($request->all());
        ImageManagerStatic::make($request->picture)->fit(301,150)->save(public_path() . "/img/sponsor/".$sponsor->id.".jpg");
        return redirect(route('sponsor.add'))->with('success', "Le sponsor a bien été ajouté !");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Editer un sponsor';
        $sponsor = Sponsor::findOrFail($id);
        $categories = SponsorCategory::lists('label', 'id');
        return view('sponsor.edit', compact('sponsor', 'page_title', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required|min:2',
            'url'         => 'required|min:2|url',
            'description' => 'required',
            'picture'     => 'image',
        ]);
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->update($request->all());
        return redirect(route('sponsor.edit', $id))->with('success', 'Le sponsor a bien été edité !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->delete();
        return redirect(route('sponsor.add'))->with('success', 'Le sponsor a bien été supprimé !');
    }
}
