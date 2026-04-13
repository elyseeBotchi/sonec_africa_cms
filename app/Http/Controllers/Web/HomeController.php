<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //page d'accueil du site web
    public function index()
    {
        return view('web.pages.index');
    }

}
