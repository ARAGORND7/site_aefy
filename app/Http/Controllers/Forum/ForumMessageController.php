<?php

namespace App\Http\Controllers\Forum;


use App\ForumSignaledMessage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ForumMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForumMessageController extends Controller
{
    /**
     * @param Request $request
     */
    public function update(Request $request, $message_id){
        $message = Message::findOrFail($message_id);
        $this->validate($request, [
           'content' => 'min:10|max:500',
        ]);
        $message->update($request->only('content'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'content'        => 'min:10|max:500',
            'forum_topic_id' => 'exists:forum_topic,id'
        ]);

        ForumMessage::create(array_add($request->only('content', 'forum_topic_id'), 'user_id', Auth::id()));

        // Récupérer les donénes manquantes
        // Puis parcourir les liste des gens intervenus sur le topic
        // Et envoyer un mail à chacun

        // Récupérer tous les messages du topic (donc leurs user)
        $users = User::all()->where('');

        // foreach
        $messages = ForumMessage::all();
        Mail::send('mails.forum', compact('token', 'user'), function($message) use ($user){
            $message->to($user->email)->subject('[Forum Aefy-Esport] Nouvelle réponse');
        });

        return redirect()->back()->with('success', 'Votre commentaire à bien été ajouté !');
    }

    public function storeSignaledMessage($message_id){
        $message = ForumMessage::findOrFail($message_id);
        ForumSignaledMessage::create([
            'forum_message_id' => $message->id
        ]);
        return redirect()->back()->with('success', "Merci d'avoir signalé ce message. Nos modérateurs vont le traiter dans les plus brefs délais.");
    }
}