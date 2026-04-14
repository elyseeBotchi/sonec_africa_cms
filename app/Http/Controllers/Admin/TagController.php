<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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
    public function store(StoreTagRequest $request)
    {
        try {
            $validated = $request->validated();
            Tag::create($validated);

            $data = [   
                        'message' => 'tag enregistré avec succès',
                        'data' => $validated,
                        'success'=>true
                    ];
            return response()->json($data, 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Erreur lors de l\'enregistrement du tag', 'error' => $th->getMessage()], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        try {
            $validated = $request->validated();
            $tag->update($validated);
            $data = [   
                    'message' => 'Tag enregistré avec succès',
                    'data' => $validated,
                    'success'=>true
                ];
            return response()->json($data, 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erreur lors de l\'enregistrement du tag', 'error' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            $data = [   
                    'message' => 'Tag supprimé avec succès',
                    'success'=>true
                ];
            return response()->json($data, 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Erreur lors de l\'enregistrement de la catégorie', 'error' => $th->getMessage()], 500);
        }
    }
}
