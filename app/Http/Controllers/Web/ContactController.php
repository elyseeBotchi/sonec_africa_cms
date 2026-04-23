<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    public function index()
    {
        return view('web.pages.contact.index');
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prenom'  => 'required|string|max:100',
            'nom'     => 'required|string|max:100',
            'email'   => 'required|email|max:255',
            'sujet'   => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ], [
            'prenom.required'  => 'Le prénom est obligatoire.',
            'nom.required'     => 'Le nom est obligatoire.',
            'email.required'   => 'L\'adresse email est obligatoire.',
            'email.email'      => 'L\'adresse email n\'est pas valide.',
            'sujet.required'   => 'Le sujet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
            'message.min'      => 'Le message doit contenir au moins 10 caractères.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Enregistrer le message dans la base de données
        ContactMessage::create([
            'prenom' => $data['prenom'],
            'nom'    => $data['nom'],
            'email'  => $data['email'],
            'sujet'  => $data['sujet'],
            'message' => $data['message'],
        ]);

        try {
            \Mail::to(get_general_settings()->contact_email ?? config('mail.from.contact_address', 'contact@sonec-africa.com'))
                ->send(new ContactMail($data));

            return response()->json([
                'success' => true,
                'message' => 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer.',
            ], 500);
        }
    }
}
