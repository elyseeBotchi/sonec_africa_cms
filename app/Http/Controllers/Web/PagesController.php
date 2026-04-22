<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(string $slug)
    {
        // Tente de charger une vue correspondant au slug
        $view = 'web.pages.' . str_replace('-', '_', $slug);
        if (view()->exists($view)) {
            return view($view);
        }
        abort(404);
    }

    public function quiSommesNous()
    {
        return view('web.pages.qui-sommes-nous.index');
    }

    public function decouvrir()
    {
        return view('web.pages.qui-sommes-nous.decouvrir-sonec-africa');
    }

    public function histoire()
    {
        return view('web.pages.qui-sommes-nous.notre-histoire');
    }

    public function equipe()
    {
        return view('web.pages.qui-sommes-nous.equipe-de-direction');
    }

    public function implantations()
    {
        return view('web.pages.qui-sommes-nous.implantations');
    }
}
