<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param $keyword
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($keyword)
    {
        $page = Pages::where('keyword', $keyword)->firstOrFail();
        $page_title = $page->title;
        return view('page.show', compact('page', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param $keyword
     * @internal param int $id
     */
    public function edit($id)
    {
        $page = Pages::findOrFail($id);
        $page_title = $page->title;
        return view('page.edit', compact('page', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param $keyword
     * @internal param int $id
     */
    public function update(Request $request, $id)
    {
        $page = Pages::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);
        $page->update($request->only('title', 'content'));
        return back()->with('success', 'La page a bien été modifiée !');
    }

    public function contact()
    {
        $page_title = "Contact";
        return view('contact', compact('page_title'));
    }

    public function contactStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        switch ($request->to) {
            case 'Général':
                $request->to = 'contact@aefy-esport.com';
                break;
            case 'Président':
                $request->to = 'jacks@aefy-esport.com';
                break;
            case 'Trésorier';
                $request->to = 'globo@aefy-esport.com';
                break;
            case 'Responsable Marketing':
                $request->to = 'kramock@aefy-esport.com';
                break;
            case 'Community Manager':
                $request->to = 'razor.CM@aefy-esport.com';
                break;
            case 'Webmaster':
                $request->to = 'np.albrecht@yahoo.fr';
                break;
        }

        Mail::send('mails.contact', compact('request'), function($message) use ($request){
            $message->from($request->email)->to($request->to)->subject('[Contact Aefy] '. $request->subject);
        });
        return back()->with('success', 'Votre message a bien été envoyé !');
    }

    public function planning(){
        $page_title = 'Planning';
        return view('page.planning', compact('page_title'));
    }
}
