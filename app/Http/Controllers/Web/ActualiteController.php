<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    //
    public function index()
    {
        $categories = \App\Models\CategorieArticle::all();
        $articles_a_la_une = \App\Models\Article::where('a_la_une', true)->latest()->take(2)->get();  
        $autres_articles = \App\Models\Article::where('a_la_une', false)->latest()->paginate(9);  
        return view('web.pages.actualites.index', compact('categories', 'articles_a_la_une', 'autres_articles'));
    }

    public function show($slug)
    {
        $article = \App\Models\Article::where('slug', $slug)->firstOrFail();
        $categories = \App\Models\CategorieArticle::all();
        $articles_a_la_une = \App\Models\Article::where('a_la_une', true)->latest()->take(2)->get();  
        
        $article_similaires = \App\Models\Article::where('id', '!=', $article->id)->latest()->take(3)->get();
        $tags = \App\Models\Tag::all();
        
        return view('web.pages.actualites.article', compact('article', 'categories', 'articles_a_la_une', 'article_similaires', 'tags'));
    }

    public function tags($slug)
    {
        $tag = \App\Models\Tag::where('slug', $slug)->firstOrFail();
        $articles = $tag->articles()->latest()->paginate(9);
        $categories = \App\Models\CategorieArticle::all();
        $articles_a_la_une = \App\Models\Article::where('a_la_une', true)->latest()->take(2)->get();  
        
        return view('web.pages.actualites.tags', compact('categories', 'articles_a_la_une', 'articles'));
    }
}
