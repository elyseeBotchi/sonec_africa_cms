<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\AccuseReceptionCandidature;
use App\Mail\NouvelleCandidature;
use App\Models\BureauPays;
use Illuminate\Http\Request;

class CarriereController extends Controller
{
    //
    public function index()
    {
        $offres = \App\Models\OffreEmploi::latest()->paginate(10);
        $bureaux = BureauPays::all();
        return view('web.pages.carrieres.index', compact('offres','bureaux'));
    }

    // Rechercher des offres d'emploi
    public function search(Request $request)
    {
        $query = \App\Models\OffreEmploi::query();
        $searchPays = $request->input('pays');
        $domaine = $request->input('domaine');
        if ($searchPays) {
            $query->whereHas('bureauPays', function ($q) use ($searchPays) {
                $q->where('pays', 'like', '%' . $searchPays . '%');
            });
        }
        if ($domaine) {
            $query->where('domaine', 'like', '%' . $domaine . '%');
        }
        $offres = $query->latest()->paginate(10);
        $bureaux = BureauPays::all();
        return view('web.pages.carrieres.index', compact('offres','bureaux'));
    }

    // Afficher les détails d'une offre d'emploi
    public function show($slug)
    {
        $offre = \App\Models\OffreEmploi::where('slug', $slug)->firstOrFail();
        return view('web.pages.carrieres.job-details', compact('offre'));
    }

    // Postuler à une candidature spontannée
    public function postulerCandidatureSpontanee(Request $request)
    {
        try {
            $validated = $request->validate([
                'prenom'          => 'required|string|max:100',
                'nom'             => 'required|string|max:100',
                'email'           => 'required|email|max:255',
                'cv'              => 'required|file|mimes:pdf,doc,docx|max:5120',
                'lettre_motivation' => 'nullable|string|max:5000',
            ], [
                'prenom.required'  => 'Le prénom est obligatoire.',
                'nom.required'     => 'Le nom est obligatoire.',
                'email.required'   => 'L\'email est obligatoire.',
                'email.email'      => 'L\'adresse email n\'est pas valide.',
                'cv.required'      => 'Le CV est obligatoire.',
                'cv.mimes'         => 'Le CV doit être au format PDF, DOC ou DOCX.',
                'cv.max'           => 'Le CV ne doit pas dépasser 5MB.',
            ]);

            // Enregistrer le CV
            $cvPath = $request->file('cv')->store('candidatures', 'public');

            $candidature = \App\Models\CandidatureSpontanee::create([
                'prenom' => $validated['prenom'],
                'nom' => $validated['nom'],
                'email' => $validated['email'],
                'cv' => $cvPath,
                'lettre_motivation' => $validated['lettre_motivation'] ?? null,
            ]);

            // Envoyer un email de notification à l'équipe RH
            \Mail::to(config('mail.from.address'))->send(new NouvelleCandidature($candidature));
            sleep(2);
            // \Mail::to($candidature->email)->send(new AccuseReceptionCandidature($candidature));
            \Mail::to($candidature->email)->later(now()->addSeconds(10), new AccuseReceptionCandidature($candidature));
            
            return response()->json([
                'success' => true,
                'message' => 'Votre candidature a bien été envoyée.',
                'data' => $candidature,
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'envoi de la candidature.',
                'error' => $th->getMessage(),
            ], 500);
        }

    }
}
