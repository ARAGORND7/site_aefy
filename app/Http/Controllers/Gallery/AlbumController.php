<?php

namespace App\Http\Controllers\Gallery;

use App\GalleryAlbum;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Validator;
use Intervention\Image\ImageManagerStatic;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Gallerie';
        $albums = GalleryAlbum::all();
        $directory = "/img/albums/";
        return view('gallery.index', compact('albums', 'page_title', 'directory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $page_title = 'Nouvel album';
        return view('gallery.add', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.wquest
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|unique:gallery_album',
            'description' => 'required:min:10',
            'cover' => 'required|image',
        ]);

        // We register the album on database
        $album = new GalleryAlbum;
        $album->name = $request->name;
        $album->description = $request->description;
        $album->user_id = $request->user_id;

        if ($album->save()) {

            // We check if the images uploaded are good or no
            $files = Input::file('images');
            foreach ($files as $f) {

                $rules = array('file' => 'image');
                $validator = Validator::make(array('file' => $f), $rules);

                if (!$validator->passes()) {
                    return redirect()->back()->with('error', $validator);
                }
            }

            // Folder creation
            $pathToCreate = public_path() . "/img/albums/" . $album->id .'/' ;
            if (!File::exists($pathToCreate)) {
                File::makeDirectory($path = $pathToCreate, $mode = 0777, $recursive = true, $force = false);
            }
            ImageManagerStatic::make($request->cover)->save($pathToCreate . "/cover.jpg");

            // We save all images
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                ImageManagerStatic::make($file)->save($pathToCreate .  $filename);

            }
        }
        return redirect()->back()->with('success', "L'album a bien été créé !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = GalleryAlbum::findOrFail($id);
        $page_title = $album->name;

        // We count the number of pictures on the album folder
        $directory = public_path() . "/img/albums/" . $album->id . "/";
        $files = glob($directory . '*.jpg');
        if ($files !== false) {
            $filecount = count($files);
        } else {
            $filecount = 0;
        }
        $urldirectory = "/img/albums/" . $album->id . "/";
        $files = File::allFiles($directory);
        return view('gallery.show', compact('album', 'page_title', 'filecount', 'urldirectory', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Editer un album';
        $album = GalleryAlbum::findOrFail($id);

        $directory = public_path() . "/img/albums/" . $album->id . "/";
        $urldirectory = "/img/albums/" . $album->id . "/";
        $files = File::allFiles($directory);
        return view('gallery.edit', compact('album', 'page_title', 'urldirectory', 'files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|\Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'required:min:10',
            'cover' => 'image',
        ]);

        $album = GalleryAlbum::findOrFail($id);
        $album->update($request->only('name', 'description'));

        // If user want change the album cover
        if ($request->cover) {
            ImageManagerStatic::make($request->cover)->save(public_path() . "/img/albums/" . $album->id . "/cover.jpg");
        }

        // We check if the images uploaded are good or no
        $files = Input::file('images');
        foreach ($files as $file) {

            $rules = array('file' => 'image');
            $validator = Validator::make(array('file' => $file), $rules);

            if (!$validator->passes()) {
                return redirect()->back()->with('error', $validator);
            }
            $filename = $file->getClientOriginalName();

            // We check if file exist for avoid error
            if (file_exists(public_path() . "/img/albums/" . $album->id . "/" . $filename)){
                // We count the number of file who already exist
                $files = glob(public_path() . "/img/albums/" . $album->id . "/" . $filename);
                $filecount = 0;
                if ( $files !== false )
                {
                    $filecount = count( $files );
                }
                $name = $file->getBasename(".jpg").$filecount;
                ImageManagerStatic::make($file)->save(public_path() . "/img/albums/" . $album->id . "/" . $name. ".jpg");
            }else{
                ImageManagerStatic::make($file)->save(public_path() . "/img/albums/" . $album->id . "/" . $filename);
            }
        }
        return redirect()->back()->with('success', "L'album a bien été edité.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $album = GalleryAlbum::findOrFail($id);
        $album->delete();
        return redirect(route('gallery.album.index'))->with('success', "L'album a bien été supprimé !");

    }

    public function pictureDelete($picture_name, $album_id)
    {
        File::delete(public_path() . '/img/albums/' . $album_id . '/' . $picture_name);
        return redirect()->back()->with('success', "L'image a bien été supprimé !");
    }
}
