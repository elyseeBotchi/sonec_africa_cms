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
        return view('admin.pages.gestion-page-accueil.index', compact('carousels', 'services', 'seo', 'accroche', 'presentation'));
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
        // if ($request->hasFile('about_image')) {
        //     $imagePath = $request->file('about_image')->store('public/about_images');
        //     $imageUrl = \Storage::url($imagePath);
        //     $validatedData['about_image_url'] = $imageUrl;
        // } else {
        //     $imageUrl = null;
        // }

        // \App\Models\PresentationEntreprise::updateOrCreate(
        //     ['page_key' => 'accueil'],
        //     [
        //         'title' => $validatedData['about_title'],
        //         'subtitle' => $validatedData['about_subtitle'],
        //         'description' => $validatedData['about_description'],
        //         'image_url' => $imageUrl,
        //         'cta_label' => $validatedData['about_cta_label'],
        //         'cta_url' => $validatedData['about_cta_url'],
        //         'annees_experience' => $validatedData['about_annees_experience'],
        //         'clients' => $validatedData['about_clients'],
        //         'pays' => $validatedData['about_pays'],
        //         'image' => $validatedData['about_image'],
        //     ]
        // );
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

        // Sauvegarde des carousels
        // if (isset($validatedData['carousels'])) {
        //     foreach ($validatedData['carousels'] as $carouselData) {
        //         if (isset($carouselData['id'])) {
        //             $carousel = \App\Models\Carousel::find($carouselData['id']);
        //             $carousel->update($carouselData);
        //         } else {
        //             // Stockage de l'image du carousel
        //             \App\Models\Carousel::create($carouselData);
        //         }
        //     }
        // }
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
