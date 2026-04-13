<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGeneralSettingRequest;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $generalSetting = GeneralSetting::first();
        return view('admin.pages.gestion-parametre-site.index', compact('generalSetting'));
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
    public function store(StoreGeneralSettingRequest $request)
    {
        //
        try {
            $validated = $request->validated();

            // Creer le dossier de stockage des images si n'existe pas
            if (!\Storage::disk('public')->exists('general_settings')) {
                \Storage::disk('public')->makeDirectory('general_settings');
            }

            // Enregistrer le logo du site
            if ($request->hasFile('site_logo')) {
                $validated['site_logo'] = $request->file('site_logo')->store('general_settings', 'public');
            }

            // Enregistrer le favicon du site
            if ($request->hasFile('site_favicon')) {
                $validated['site_favicon'] = $request->file('site_favicon')->store('general_settings', 'public');
            }

            // Enregistrer le logo du footer
            if ($request->hasFile('logo_footer')) {
                $validated['logo_footer'] = $request->file('logo_footer')->store('general_settings', 'public');
            }

            GeneralSetting::updateOrCreate(['id' => 1], $validated);

            $data = [
                'success' => true,
                'message' => 'Paramètres généraux mis à jour avec succès.',
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour des paramètres généraux.',
                'error' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeneralSetting $generalSetting)
    {
        //
        try {
            $validated = $request->validate([
                'site_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'contact_email' => 'nullable|email|max:255',
                'contact_phone' => 'nullable|string|max:20',
                'contact_address' => 'nullable|string|max:255',
                'meta_title' => 'nullable|string|max:255',
                'meta_keywords' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            ]);

            // Creer le dossier de stockage des images si n'existe pas
            if (!\Storage::disk('public')->exists('general_settings')) {
                \Storage::disk('public')->makeDirectory('general_settings');
            }

            // Enregistrer le logo du site
            if ($request->hasFile('site_logo')) {
                $validated['site_logo'] = $request->file('site_logo')->store('general_settings', 'public');
            }

            // Enregistrer le favicon du site
            if ($request->hasFile('site_favicon')) {
                $validated['site_favicon'] = $request->file('site_favicon')->store('general_settings', 'public');
            }

            // Enregistrer le logo du footer
            if ($request->hasFile('logo_footer')) {
                $validated['logo_footer'] = $request->file('logo_footer')->store('general_settings', 'public');
            }

            GeneralSetting::updateOrCreate(['id' => 1], $validated);
            $data = [
                    'success' => true,
                    'message' => 'Paramètres généraux mis à jour avec succès.',
                ];
            return response()->json($data, 200);

        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour des paramètres généraux.',
                'error' => $e->getMessage(),
            ];
            return response()->json($data, 500);
        }            
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneralSetting $generalSetting)
    {
        //
    }
}
