<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    //
    public function index()
    {
        $categories = \App\Models\CategorieArticle::all();
        $tags = \App\Models\Tag::all();
        $articles = \App\Models\Article::all();


        return view('admin.pages.actualites.index', compact('categories', 'tags','articles'));
    }
}
