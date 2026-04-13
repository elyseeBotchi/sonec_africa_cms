<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Methode affichant le dashboard de l'administration
    public function index()
    {
        return view('admin.dashboard');
    }
}
