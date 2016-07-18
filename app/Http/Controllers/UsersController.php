<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class UsersController extends Controller
{

    /**
     * UsersController constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            $page_title = 'Inscription';
            return view('users.register', compact('page_title'));
        }
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
            'nickname' => 'required|max:60|unique:users|alpha_num',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6|',
        ]);

        $token = str_random(20);

        $user = User::create([
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => $token,
        ]);

        Mail::send('mails.user-register', compact('token', 'user'), function ($message) use ($user) {
            $message->to($user->email)->subject('Confirmation de votre inscription');
        });
        return redirect(route('users.register'))->with('success', "Votre compte a bien été crée mais vous devez confirmer votre adresse mail.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $userId
     * @return \Illuminate\Http\Response
     */
    public function edit($userId)
    {
        $user = User::findOrFail($userId);

        if (Auth::check() && $user == Auth::user() || Auth::check() && Auth::user()->hasRole('Administrateur')) {
            $page_title = 'Editer son profil';
            return view('users.edit', compact('page_title', 'user'));
        } else {
            return back()->with('error', "Vous n'êtes pas autorisé à modifier ce profile !");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $userId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        if ($user) {
            if (Auth::check() && $user == Auth::user() || Auth::check() && Auth::user()->hasRole('Administrateur')) {
                $this->validate($request, [
                    'nickname' => "required|unique:users,nickname,{$user->id}|min:2",
                    'last_name' => 'min:2',
                    'first_name' => 'min:2',
                    'email' => 'required|email',
                    'date_of_birth' => 'date_format:d/m/Y',
                    'country' => 'min:2',
                    'city' => 'min:2',
                    'signature' => 'min:2',
                    'avatar' => 'image',
                ]);
                //Format the date for the database
                if ($request->date_of_birth != null) {
                    $request->merge(['date_of_birth' => Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->format('Y-m-d')]);
                }
                // User update
                $user->update($request->only('nickname', 'email', 'last_name', 'first_name', 'gender', 'date_of_birth', 'country', 'city', 'games', 'avatar'));
                return back()->with('success', "Votre profile a bien été modifié !");
            } else {
                return back()->with('error', "Vous n'êtes pas autorisé à modifier ce profile !");
            }
        } else {
            return redirect('/')->with('error', 'Profile inexisant');
        }
    }

    /**
     * Confirm the user inscription
     * @param Request $request
     * @param $userId
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm(Request $request, $userId, $token)
    {
        $user = User::findOrFail($userId);
        if ($user->confirmed == false) {
            if ($user->remember_token == $token) {
                $user->remember_token = null;
                $user->confirmed = true;
                $user->save();
            } else {
                return redirect('/')->with('error', 'Le token est invalide !');
            }
        } else {
            redirect('/')->with('error', 'Ce compte a déjà été validé !');
        }

        Auth::login($user);

        return redirect('/')->with('success', 'Votre compte a bien été confirmé  ! Vous pouvez maintenant vous connecter.');
    }

    /**
     * Display the login form
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        $page_title = 'Se connecter';
        return view('users.login', compact('page_title'));
    }

    /**
     * Valid the login form
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required|alpha_num',
            'password' => 'required'
        ]);

        $user = User::where('nickname', $request->get('nickname'))->first();
        if ($user) {
            if (DB::table('users_ban')->where('user_id', $user->id)->count() === 0) {
                if ($user && Hash::check($request->get('password'), $user->password)) {
                    $this->auth->login($user, $request->has('remember'));
                    return redirect('/')->with('success', 'Bienvenue');
                } else {
                    return redirect('/login')->withInput($request->only('nickname', 'remember'))->withErrors('error', 'Identifiants inccorrects');
                }
            } else {
                return back()->with('error', 'Erreur: vous êtes actuellement banni du site !');
            }
        } else {
            return redirect('/login')->withInput($request->only('nickname', 'remember'))->withErrors('error', 'Identifiants inccorrects');
        }
    }

    /**
     * Disconnect a user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/')->with('success', 'A bientôt ! :)');
        } else {
            return redirect()->route('/');
        }
    }

    /**
     * Display the password reset form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEmailFormForPasswordReset()
    {
        $page_title = 'Mot de passe oublié';
        return view('users.reset', compact('page_title'));
    }

    /**
     * Valid the password reset form
     * @param Request $request
     * @return $this|bool
     */
    public function storeEmailFormForPasswordReset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        // If Email exists
        if (User::where('email', $request->email)->count() > 0) {
            $email = $request->email;
            $token = str_random(12);

            DB::table('password_resets')->insert(['email' => $email, 'token' => $token, 'created_at' => Carbon::now()->toDateTimeString()]);

            Mail::send('mails.user-password', compact('token', 'email'), function ($message) use ($request) {
                $message->to($request->email)->subject('Mot de passe oublié');
            });
            return redirect('/password/reset/form')->with('success', 'Email envoyé');
        } else {
            return redirect('/password/reset/form')->withInput([$request->email])->with('error', 'Addresse mail inexistante');
        }
    }

    /**
     * Check the token and display the reset password form
     * @param $token
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmPasswordReset($token, $email)
    {
        $tokenDatabase = DB::table('password_resets')->where('token', $token)->first();
        if ($tokenDatabase == false || $tokenDatabase->email != $email) {
            return redirect('/')->withErrors('error', 'Une erreur est survenue lors de la validation de votre requête ...');
        } else {
            $page_title = 'Changement de mot de passe';
            return view('users.changePassword', compact('page_title', 'tokenDatabase'));
        }
    }

    public function storePasswordReset(Request $request, $token, $email)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6|',
        ]);
        DB::table('password_resets')->where('token', $token)->delete();
        DB::table('users')->where('email', $email)->update(['password' => bcrypt($request->password)]);
        return redirect('/')->with('success', 'Votre mot de passe a bien été changé. Vous pouvez maintenant vous connecter avec celui-ci.');
    }

    public function getBroker()
    {
        return property_exists($this, 'broker') ? $this->broker : null;
    }
}
