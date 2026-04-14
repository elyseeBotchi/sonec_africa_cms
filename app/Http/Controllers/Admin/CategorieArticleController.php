<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategorieArticleRequest;
use App\Http\Requests\UpdateCategorieArticleRequest;
use App\Models\CategorieArticle;
use Illuminate\Http\Request;

class CategorieArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCategorieArticleRequest $request)
    {
        try {

            $validated = $request->validated();
            $validated['page_key'] = 'actualites';
            CategorieArticle::create($validated);

            $data = [   
                        'message' => 'Catégorie enregistrée avec succès',
                        'data' => $validated,
                        'success'=>true
                    ];
            return response()->json($data, 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Erreur lors de l\'enregistrement de la catégorie', 'error' => $th->getMessage()], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CategorieArticle $categorieArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategorieArticle $categorieArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieArticleRequest $request, CategorieArticle $categorieArticle)
    {
        try {
            //code...
            $validated = $request->validated();
            $categorieArticle->update($validated);
            $data = [   
                    'message' => 'Catégorie modifiée avec succès',
                    'data' => $validated,
                    'success'=>true
                ];
            return response()->json($data, 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Erreur lors de l\'enregistrement de la catégorie', 'error' => $th->getMessage()], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategorieArticle $categorieArticle)
    {
        try {
            //code...
            $categorieArticle->delete();
            $data = [   
                    'message' => 'Catégorie supprimée avec succès',
                    'success'=>true
                ];
            return response()->json($data, 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Erreur lors de l\'enregistrement de la catégorie', 'error' => $th->getMessage()], 500);

        }
    }
}
