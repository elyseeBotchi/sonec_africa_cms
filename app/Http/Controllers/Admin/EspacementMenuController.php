<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEspacementMenuRequest;
use App\Http\Requests\UpdateEspacementMenuRequest;
use App\Models\EspacementMenu;
use Illuminate\Http\Request;

class EspacementMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $espacementMenus = EspacementMenu::with('menu')->get();


        $menuIds = $espacementMenus->pluck('menu_id')->toArray();
        $menusWithoutEspacement = \App\Models\Menu::whereNull('parent_id')
                                            ->whereType('megamenu')
                                            ->orwhere('type', 'dropdown')
                                            ->get();
        return view('admin.pages.gestion-menu.espacementMegamenu', compact('espacementMenus', 'menusWithoutEspacement'));
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
    public function store(StoreEspacementMenuRequest $request)
    {
        //
        try {
            $validated = $request->validated();

            $validated['gras'] = $validated['gras'] == 1 ? true : false;
            $validated['italique'] = $validated['italique'] == 1 ? true : false;
            $validated['couleur_fond_icon'] = $validated['couleur_fond_icon'] == 1 ? true : false;


            EspacementMenu::create($validated);

            $data = [
                'success' => true,
                'message' => 'Espacement de menu créé avec succès.',
            ];
            return response()->json($data, 201);
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la création de l\'espacement de menu.',
                'error' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EspacementMenu $espacementMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EspacementMenu $espacementMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEspacementMenuRequest $request, EspacementMenu $espacementMenu)
    {
        //
        try {
            $validated = $request->validated();
            $validated['gras'] = $validated['gras'] == 1 ? true : false;
            $validated['italique'] = $validated['italique'] == 1 ? true : false;
            $validated['couleur_fond_icon'] = $validated['couleur_fond_icon'] == 1 ? true : false;

            $espacementMenu->update($validated);

            $data = [
                'success' => true,
                'message' => 'Espacement de menu mis à jour avec succès.',
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour de l\'espacement de menu.',
                'error' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EspacementMenu $espacementMenu)
    {
        //
        try {
            $espacementMenu->delete();

            $data = [
                'success' => true,
                'message' => 'Espacement de menu supprimé avec succès.',
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression de l\'espacement de menu.',
                'error' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }
}
