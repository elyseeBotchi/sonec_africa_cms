<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     * enregistre l'email dans la table newsletters et retourne une réponse JSON indiquant le succès ou l'échec de l'opération.
     */
    public function store(Request $request)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'email'   => 'required|email|max:255|unique:newsletters,email',
            ], [
                'email.required'   => 'L\'adresse email est obligatoire.',
                'email.email'      => 'L\'adresse email n\'est pas valide.',
                'email.unique'     => 'Cette adresse email est déjà inscrite à la newsletter.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $data = $validator->validated();

            Newsletter::create([
                'email' => $data['email'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Merci de vous être inscrit à notre newsletter !',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'inscription à la newsletter.',
            ], 500);
        }
    }

    
}
