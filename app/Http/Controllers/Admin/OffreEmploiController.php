<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOffreEmploiRequest;
use App\Http\Requests\UpdateOffreEmploiRequest;
use App\Models\BureauPays;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;

class OffreEmploiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $page_key = 'carriere';
        $offresEmploi = OffreEmploi::with('bureauPays')->get();
        $bureauxPays = BureauPays::all();
        return view('admin.pages.gestion-carriere.index', compact('offresEmploi', 'bureauxPays', 'page_key'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOffreEmploiRequest $request)
    {
        //
        try {
            $validated = $request->validated();

            $offreEmploi = OffreEmploi::create([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'lieu' => $validated['lieu'] ?? null,
                'type_contrat' => $validated['type_contrat'] ?? null,
                'departement' => $validated['departement'] ?? null,
                'niveau_experience' => $validated['niveau_experience'] ?? null,
                'salaire' => $validated['salaire'] ?? null,
                'email_contact' => $validated['email_contact'] ?? null,
                'date_expiration' => $validated['date_expiration'] ?? null,
                'bureau_pays_id' => $validated['bureau_pays_id'] ?? null,
                'status' => $validated['status'] ?? null,
                'page_key' => $validated['page_key'] ?? null,
                'section_key' => $validated['section_key'] ?? null,
                'missions' => $validated['missions'] ?? null,
                'profil_recherche' => $validated['profil_recherche'] ?? null,
                'avantages' => $validated['avantages'] ?? null,
                'domaine' => $validated['domaine'] ?? null,
            ]);

            // creer le slug de l'offre d'emploi
            $offreEmploi->slug = \Str::slug($offreEmploi->title);
            $offreEmploi->save();

            $data = [
                'success' => true,
                'message' => 'Offre d\'emploi sauvegardée avec succès.',
                'data' => $offreEmploi,
            ];
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde de l\'offre d\'emploi.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OffreEmploi $offreEmploi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OffreEmploi $offreEmploi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOffreEmploiRequest $request, OffreEmploi $offres_emploi)
    {
        //
        try {
            $validated = $request->validated();

            // Si le slug est vide ou null, le générer à partir du titre
            if (empty($validated['slug'])|| is_null($offres_emploi->slug)) {
                $offres_emploi->slug = \Str::slug($validated['title']);
            }

            $offres_emploi->update($validated);

            $data = [
                'success' => true,
                'message' => 'Offre d\'emploi mise à jour avec succès.',
                'data' => $offres_emploi->fresh(), 
            ];
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour de l\'offre d\'emploi.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffreEmploi $offres_emploi)
    {
        //
        try {
            $offres_emploi->delete();

            $data = [
                'success' => true,
                'message' => 'Offre d\'emploi supprimée avec succès.',
            ];
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression de l\'offre d\'emploi.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }
}

