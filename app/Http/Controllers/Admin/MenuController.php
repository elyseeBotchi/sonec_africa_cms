<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('position')->get();

        
        $sidebarMenus = \App\Models\SidebarMenu::with('menu')->get();
        // $sidebarMenuIds = $sidebarMenus->pluck('menu_id')->toArray();

        $menusPrincipaux = \App\Models\Menu::whereNull('parent_id')
                                            ->whereType('megamenu')
                                            ->orwhere('type', 'dropdown')
                                            ->get();

        return view('admin.pages.gestion-menu.index', compact('menus', 'sidebarMenus', 'menusPrincipaux'));
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
    public function store(StoreMenuRequest $request)
    {
        try {
            $validated = $request->validated();

            // gerer le champ is_active et is_external
            // $validated['is_active'] = $request->has('is_active') === 1 ? true : false;
            // $validated['is_external'] = $request->has('is_external') === 1 ? true : false;
            $validated['is_active'] = $validated['is_active'] == 1 ? true : false;
            $validated['is_external'] = $validated['is_external'] == 1 ? true : false;

            // rechercher les menus existants pour definir la position du nouveau menu en fonction du pareint_id
            $position = Menu::where('parent_id', $validated['parent_id'])->max('position');
            $validated['position'] = $position + 1;

            // Creer le dossier de stockage des images si n'existe pas
            if (!\Storage::disk('public')->exists('menus')) {
                \Storage::disk('public')->makeDirectory('menus');
            }

            // Enregistrer l'image
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('menus', 'public');
            }

            // mettre à jour le slug en fonction du titre et si un sous-menu est créé, le slug doit être formé du slug du parent suivi du slug du menu enfant
            $validated['slug'] = \Str::slug($validated['slug'] ?? $validated['label'], '-');
            

            Menu::create($validated);

            $data = [   
                        'message' => 'Menu enregistré avec succès',
                        'data' => $validated,
                        'success'=>true
                    ];
            return response()->json($data, 201);
        
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Erreur lors de l\'enregistrement du menu', 'error' => $th->getMessage()], 500);
        }
       
    }

    // Mettre à jour la position des menus
    public function updatePosition(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);

            $position = Menu::where('parent_id', $request->parent_id)->max('position');
            $menu->position = $position + 1;

            $menu->position = $request->position;
            $menu->save();
        return response()->json(['message' => 'Position mise à jour avec succès', 'success' => true], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Erreur lors de la mise à jour de la position', 'success' => false], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
        return response()->json(['message' => 'Menu récupéré avec succès', 'data' => $menu, 'success' => true], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        try {
            $validated = $request->validated();



            // gerer le champ is_active et is_external
            $validated['is_active'] = $validated['is_active'] == 1 ? true : false;
            $validated['is_external'] = $validated['is_external'] == 1 ? true : false;

            // Enregistrer l'image
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($menu->image && \Storage::disk('public')->exists($menu->image)) {
                    \Storage::disk('public')->delete($menu->image);
                }
                $validated['image'] = $request->file('image')->store('menus', 'public');
            }

            // mettre à jour le slug en fonction du titre et si un sous-menu est créé, le slug doit être formé du slug du parent suivi du slug du menu enfant
            $validated['slug'] = $menu->slug ?? \Str::slug($validated['slug'] ?? $validated['label'], '-');

            $menu->update($validated);

            return response()->json(['message' => 'Menu mis à jour avec succès', 'data' => $menu, 'success' => true], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Erreur lors de la mise à jour du menu', 'error' => $th->getMessage(), 'success' => false], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
        try {
            // Supprimer l'image associée au menu si elle existe
            if ($menu->image && \Storage::disk('public')->exists($menu->image)) {
                \Storage::disk('public')->delete($menu->image);
            }

            $menu->delete();

            return response()->json(['message' => 'Menu supprimé avec succès', 'success' => true], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Erreur lors de la suppression du menu', 'error' => $th->getMessage(), 'success' => false], 500);
        }
    }
}
