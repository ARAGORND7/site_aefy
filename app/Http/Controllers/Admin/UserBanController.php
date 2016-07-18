<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserBan;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBanController extends Controller
{

    public function index()
    {
        $banList = UserBan::paginate(20);
        $page_title = 'Liste des bannis';
        return view('admin.ban.index', compact('banList', 'page_title'));
    }

    public function create($id)
    {
        $user = User::findOrFail($id);
        // Check if the user is already banned or no
        if (DB::table('users_ban')->where('user_id',$user->id)->count() > 0){
            return back()->with('error', 'Cet utilisateur est déjà banni');
        }
        $page_title = 'Créer un ban';
        return view('admin.ban.create', compact('page_title', 'user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'end_date' => 'required|min:0|numeric',
            'reason' => 'required'
        ]);
        Carbon::setLocale('fr');
        if ($request->end_date !== 0) {
            $request->merge(['end_date' => Carbon::now()->addDay($request->end_date)]);
        } else {
            $request->merge(['end_date' => null]);
        }
        UserBan::create($request->all());
        return redirect()->route('admin.ban.index')->with('success', 'La personne est maintenant banni');
    }

    public function edit($id)
    {
        $ban = UserBan::findOrFail($id);
        $page_title = 'Editer le ban';
        return view('admin.ban.edit', compact('page_title', 'ban'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'end_date' => 'required|numeric',
            'reason' => 'required'
        ]);
        $ban = UserBan::findOrFail($id);
        if ($request->end_date !== 0) {
            $time = Carbon::createFromFormat('Y-m-d H:i:s', $ban->end_date)->addDays($request->end_date);
            if ($time->lte($ban->created_at)) {
                return back()->withInput()->with('error', 'La date de fin de ban est inférieur à la date de création.');
            } else {
                $request->merge(['end_date' => $time]);
            }

        }
        $ban->update($request->only('end_date', 'reason'));
        return back()->with('success', 'Le ban a bien été mis à jour');
    }

    public function delete($id)
    {
        $ban = UserBan::findOrFail($id);
        $ban->delete();
        return back()->with('success', 'Le ban a bien été supprimé !');
    }
}