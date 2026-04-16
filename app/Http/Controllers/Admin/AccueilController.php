<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccueilContentRequest;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    //
    public function index()
    {
        $carousels = \App\Models\Carousel::orderBy('position')->get();
        $services = \App\Models\Service::all();
        $seo = \App\Models\Seo::where('page_key', 'accueil')->first();
        $accroche = \App\Models\Accroche::where('page_key', 'accueil')->first();
        $presentation = \App\Models\PresentationEntreprise::where('page_key', 'accueil')->first();

        $temoignages = \App\Models\Temoignage::where('page_key', 'accueil')->orderBy('created_at', 'desc')->get();
        $clients = \App\Models\Client::where('page_key', 'accueil')->orderBy('created_at', 'desc')->get();
        $partenaires = \App\Models\Partenaire::where('page_key', 'accueil')->orderBy('created_at', 'desc')->get();  



        return view('admin.pages.gestion-page-accueil.index', compact('carousels', 'services', 'seo', 'accroche', 'presentation', 'temoignages', 'clients', 'partenaires'));
    }

    public function save(StoreAccueilContentRequest $request)
    {
        \Log::info('Request data:', $request->all());
       try {
        

        $validatedData = $request->validated();

        // Sauvegarde de l'accroche
        \App\Models\Accroche::updateOrCreate(
            ['page_key' => $validatedData['accroche_page_key']],
            [
                'title' => $validatedData['accroche_title'],
                'subtitle' => $validatedData['accroche_subtitle'],
                'description' => $validatedData['accroche_description'],
                'cta_label' => $validatedData['accroche_cta_label'],
                'cta_url' => $validatedData['accroche_cta_url'],
            ]
        );       
        // Sauvegarde de la section "À propos"
        $imagePath = null;

        if ($request->hasFile('about_image')) {
            // Supprimer l'ancienne image si elle existe
            $existing = \App\Models\PresentationEntreprise::where('page_key', 'accueil')->first();
            if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                \Storage::delete('public/' . $existing->image);
            }

            $imagePath = $request->file('about_image')->store('about_images', 'public');
        }

        \App\Models\PresentationEntreprise::updateOrCreate(
            ['page_key' => 'accueil'],
            [
                'title'               => $validatedData['about_title'] ?? null,
                'subtitle'            => $validatedData['about_subtitle'] ?? null,
                'description'         => $validatedData['about_description'] ?? null,
                'annees_experience'   => $validatedData['about_annees_experience'] ?? null,
                'clients'             => $validatedData['about_clients'] ?? null,
                'pays'                => $validatedData['about_pays'] ?? null,
                'cta_label'           => $validatedData['about_cta_label'] ?? null,
                'cta_url'             => $validatedData['about_cta_url'] ?? null,
                'image_url'           => $validatedData['about_image_url'] ?? null,
                ...($imagePath ? ['image' => $imagePath] : []),
            ]
        );

        // Sauvegarde du SEO
        \App\Models\Seo::updateOrCreate(
            ['page_key' => $validatedData['seo_page_key']],
            [
                'title' => $validatedData['seo_title'],
                'description' => $validatedData['seo_description'],
                'keywords' => $validatedData['seo_keywords'],
            ]
        );

        
        if (isset($validatedData['carousels'])) {
            foreach ($validatedData['carousels'] as $index => $carouselData) {
                
                // Récupérer le fichier image s'il existe (pas dans validatedData car c'est un fichier)
                $imageFile = $request->file("carousels.{$index}.image");

                if (isset($carouselData['id'])) {
                    // Mise à jour d'un carousel existant
                    $carousel = \App\Models\Carousel::find($carouselData['id']);

                    if (!$carousel) continue;

                    if ($imageFile) {
                        // Supprimer l'ancienne image si elle existe
                        if ($carousel->image && \Storage::exists('public/' . $carousel->image)) {
                            \Storage::delete('public/' . $carousel->image);
                        }

                        // Stocker la nouvelle image
                        $path = $imageFile->store('carousels', 'public');
                        $carouselData['image'] = $path;
                    }

                    // Retirer l'id du tableau avant la mise à jour
                    unset($carouselData['id']);
                    $carousel->update($carouselData);

                } else {
                    // Création d'un nouveau carousel
                    if ($imageFile) {
                        $path = $imageFile->store('carousels', 'public');
                        $carouselData['image'] = $path;
                    }

                    \App\Models\Carousel::create($carouselData);
                }
            }
        }

        // Sauvegarde des services
        if (isset($validatedData['services'])) {
            foreach ($validatedData['services'] as $serviceData) {
                
                if (empty($serviceData['title'])) continue;

                if (isset($serviceData['id'])) {
                    $service = \App\Models\Service::find($serviceData['id']);
                    if (!$service) continue;

                    $id = $serviceData['id'];
                    unset($serviceData['id']); 
                    $service->update($serviceData);
                } else {
                    \App\Models\Service::create($serviceData);
                }
            }
        }

        // Sauvegarde des partenaires 
        if (isset($validatedData['partenaires'])) {
            foreach ($validatedData['partenaires'] as $index => $partenaireData) {
                $imageFile = $request->file("partenaires.{$index}.logo");
                if (!empty($partenaireData['id'])) {
                    $partenaire = \App\Models\Partenaire::find($partenaireData['id']);
                    if (!$partenaire) continue;

                    if ($imageFile) {
                        if ($partenaire->logo && \Storage::exists('public/' . $partenaire->logo)) {
                            \Storage::delete('public/' . $partenaire->logo);
                        }
                        $path = $imageFile->store('partenaires', 'public');
                        $partenaireData['logo'] = $path;
                    }

                    unset($partenaireData['id']);
                    $partenaire->update($partenaireData);
                } else {
                    if ($imageFile) {
                        $path = $imageFile->store('partenaires', 'public');
                        $partenaireData['logo'] = $path;
                    }
                    \App\Models\Partenaire::create($partenaireData);
                }
            }
        }

        // Sauvegarde des témoignages  avec gestion des images
        if (isset($validatedData['temoignages'])) {
            foreach ($validatedData['temoignages'] as $index => $temoignageData) {
                $imageFile = $request->file("temoignages.{$index}.logo");
                if (isset($temoignageData['id'])) {
                    $temoignage = \App\Models\Temoignage::find($temoignageData['id']);
                    if (!$temoignage) continue;     
                    if ($imageFile) {
                        if ($temoignage->logo && \Storage::exists('public/' . $temoignage->logo)) {
                            \Storage::delete('public/' . $temoignage->logo);
                        }
                        $path = $imageFile->store('temoignages', 'public');
                        $temoignageData['logo'] = $path;
                    }
                    unset($temoignageData['id']);
                    $temoignage->update($temoignageData);
                } else {
                    if ($imageFile) {
                        $path = $imageFile->store('temoignages', 'public');
                        $temoignageData['logo'] = $path;
                    }
                    \App\Models\Temoignage::create($temoignageData);
                }
            }
        }

        // Sauvegarde des clients avec gestion des images
        if (isset($validatedData['clients'])) {
            foreach ($validatedData['clients'] as $index => $clientData) {
                $imageFile = $request->file("clients.{$index}.logo");
                if (!empty($clientData['id'])) {
                    $client = \App\Models\Client::find($clientData['id']);
                    if (!$client) continue; 
                    if ($imageFile) {
                        if ($client->logo && \Storage::exists('public/' . $client->logo)) {
                            \Storage::delete('public/' . $client->logo);
                        }
                        $path = $imageFile->store('clients', 'public');
                        $clientData['logo'] = $path;
                    }
                    unset($clientData['id']);
                    $client->update($clientData);
                } else {
                    if ($imageFile) {
                        $path = $imageFile->store('clients', 'public');
                        $clientData['logo'] = $path;
                    }
                    \App\Models\Client::create($clientData);
                }
            }
        }
        
        




        $data = [
                'success' => true,
                'message' => 'Contenu de la page d\'accueil sauvegardé avec succès.',
            ];
            return response()->json($data, 200);

       } catch (\Throwable $th) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde du contenu de la page d\'accueil.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
       }
    }
}
