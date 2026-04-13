<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSidebarMenuRequest;
use App\Http\Requests\UpdateSidebarMenuRequest;
use App\Models\SidebarMenu;
use Illuminate\Http\Request;

class SidebarMenuController extends Controller
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
    public function store(StoreSidebarMenuRequest $request)
    {
        //
        try {
            $validated = $request->validated();

            // Creer le dossier de stockage des images si n'existe pas
            if (!\Storage::disk('public')->exists('sidebar_menus')) {
                \Storage::disk('public')->makeDirectory('sidebar_menus');
            }

            // Enregistrer l'image
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('sidebar_menus', 'public');
            }

            SidebarMenu::create($validated);

            $data = [
                'success' => true,
                'message' => 'Menu de la sidebar créé avec succès.',
            ];
            return response()->json($data, 201);
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la création du menu de la sidebar.',
                'error' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SidebarMenu $sidebarMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SidebarMenu $sidebarMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSidebarMenuRequest $request, SidebarMenu $sidebarMenu)
    {
        //
        try {
            $validated = $request->validated();

            // Enregistrer l'image
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($sidebarMenu->image) {
                    \Storage::disk('public')->delete($sidebarMenu->image);
                }
                $validated['image'] = $request->file('image')->store('sidebar_menus', 'public');
            }

            $sidebarMenu->update($validated);

            $data = [
                'success' => true,
                'message' => 'Menu de la sidebar mis à jour avec succès.',
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour du menu de la sidebar.',
                'error' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SidebarMenu $sidebarMenu)
    {
        //
        try {
            // Supprimer l'image si elle existe
            if ($sidebarMenu->image) {
                \Storage::disk('public')->delete($sidebarMenu->image);
            }

            $sidebarMenu->delete();

            $data = [
                'success' => true,
                'message' => 'Menu de la sidebar supprimé avec succès.',
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression du menu de la sidebar.',
                'error' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }

    }
}
