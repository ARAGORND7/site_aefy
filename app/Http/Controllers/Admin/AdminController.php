<?php

namespace App\Http\Controllers\Admin;


use App\ForumTopic;
use App\GalleryAlbum;
use App\Http\Controllers\Controller;
use App\News;
use App\Pages;
use App\Sponsor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{

    public function index()
    {

        $page_title = 'Administration';
        $memberscount = User::all()->count();
        $newscount = News::all()->count();
        $albumscount = GalleryAlbum::all()->count();
        $topicscount = ForumTopic::all()->count();

        return view('admin.index', compact('page_title', 'memberscount', 'newscount', 'albumscount', 'topicscount'));
    }

    public function news()
    {
        $page_title = 'News';
        $news = News::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.news', compact('page_title', 'news'));
    }

    public function permissions()
    {
        $permissions = DB::table('permissions')->get();
        $roles = DB::table('roles')->get();
        $page_title = "Permissions";
        return view('admin.permissions', compact('page_title', 'permissions', 'roles'));
    }

    public function sponsor()
    {
        $page_title = 'Sponsor';
        $sponsor = Sponsor::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.sponsor', compact('page_title', 'sponsor'));
    }

    public function pages()
    {
        $page_title = 'Gestion des Pages';
        $pages = Pages::all();
        return view('admin.pages', compact('page_title', 'pages'));
    }

    public function members()
    {
        $page_title = 'Membres';
        $users = User::paginate(15);
        return view('admin.users', compact('page_title', 'users'));
    }

    public function permissionsEdit(Request $request)
    {
        $roles = DB::table('roles')->get();
        foreach ($roles as $role) {
            $r = $role->id;
            $input = $request->$r;
            foreach ($input as $key=>$value) {
                if ($value === 'grant') {
                    if (DB::table('role_has_permissions')->where(['role_id' => $role->id, 'permission_id' => $key])->count() == 0){
                        DB::table('role_has_permissions')->insert(['role_id' => $role->id, 'permission_id' => $key]);
                    }
                } else {
                    if (DB::table('role_has_permissions')->wherePermissionId($key)->whereRoleId($role->id)->count() != 0) {
                        DB::table('role_has_permissions')->wherePermissionId($key)->whereRoleId($role->id)->delete();
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Les changements ont bien été enregistrés.');
    }

    public function planning(){
        $page_title = 'Modifier le planning';
        return view('admin.planning', compact('page_title'));
    }

    public function planningStore(Request $request){
        $this->validate($request, [
            'planning' => 'required|image',
        ]);
        ImageManagerStatic::make($request->planning)->save(public_path() . "/img/planning/planning.jpg");
        return back()->with('success', 'Le planning a bien été mis à jour');
    }
}