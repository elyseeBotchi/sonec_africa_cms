<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\CategorieArticle;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
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
        $categorie_articles = CategorieArticle::get();
        $tags = Tag::get();

        return view('admin.pages.actualites.pages.create-article', compact('categorie_articles','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['page_key'] = 'actualites';

            $validated['is_published'] = $validated['is_published'] == 1 ? true : false;
            $validated['activer_partage_reseaux_sociaux'] = $validated['activer_partage_reseaux_sociaux'] == 1 ? true : false;

            // Sauvegarder l'image de couverture
            if (!\Storage::disk('public')->exists('articles')) {
                \Storage::disk('public')->makeDirectory('articles');
            }

            // Enregistrer l'image
            if ($request->hasFile('image_article')) {
                $validated['image_article'] = $request->file('image_article')->store('articles', 'public');
            }



            if (!\Storage::disk('public')->exists('auteur_articles')) {
                \Storage::disk('public')->makeDirectory('auteur_articles');
            }

            // Enregistrer l'image auteur
            if ($request->hasFile('photo_auteur')) {
                $validated['photo_auteur'] = $request->file('photo_auteur')->store('articles', 'public');
            }

            $article = Article::create($validated);

            // Synchroniser avec les tags si c'est sélectionné
            if ($request->has('tags')) {
                $article->tags()->sync($request->tags);
            }

            $data = [   
                        'message' => 'Article enregistré avec succès',
                        'data' => $validated,
                        'success'=>true
                    ];
            return response()->json($data, 201);
        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la création de l\'article.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
            // return response()->json(['message' => 'Erreur lors de l\'enregistrement du tag', 'error' => $th->getMessage()], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        $categorie_articles = CategorieArticle::get();
        $tags = Tag::get();

        // dd($article);

        return view('admin.pages.actualites.pages.edit-article', compact('categorie_articles','tags','article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        try {
            $validated = $request->validated();

            $validated['is_published'] = $validated['is_published'] == 1 ? true : false;
            $validated['activer_partage_reseaux_sociaux'] = $validated['activer_partage_reseaux_sociaux'] == 1 ? true : false;


            // Enregistrer l'image
            if ($request->hasFile('image_article')) {
                // Supprimer l'ancienne image si elle existe
                if ($article->image_article) {
                    \Storage::disk('public')->delete($article->image_article);
                }
                $validated['image_article'] = $request->file('image_article')->store('articles', 'public');
            }

            // Enregistrer photo auteur
            if ($request->hasFile('photo_auteur')) {
                // Supprimer l'ancienne image si elle existe
                if ($article->photo_auteur) {
                    \Storage::disk('public')->delete($article->photo_auteur);
                }
                $validated['photo_auteur'] = $request->file('photo_auteur')->store('auteur_articles', 'public');
            }

            $article->update($validated);

            $article->tags()->sync($request->tags ?? []);

            $data = [
                'success' => true,
                'message' => 'Article mis à jour avec succès.',
                'data' => $article
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour du menu de la sidebar.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
        try {
            // Supprimer les images associées à l'article
            if ($article->image_article) {
                \Storage::disk('public')->delete($article->image_article);
            }
            if ($article->photo_auteur) {
                \Storage::disk('public')->delete($article->photo_auteur);
            }

            // Supprimer les tags associés
            $article->tags()->detach();

            $article->delete();

            $data = [
                'success' => true,
                'message' => 'Article supprimé avec succès.',
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression de l\'article.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }
}
