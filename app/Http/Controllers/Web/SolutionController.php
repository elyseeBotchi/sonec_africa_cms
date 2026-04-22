<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    //
    public function index()
    {
        $solutions = Solution::where('mis_avant', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('web.pages.solutions.index', compact('solutions'));
    }
    public function show(string $slug)
    {
        $solution = Solution::where('slug', $slug)->firstOrFail();

        $solution->load([
            'fonctionnalites',
            'chiffres',
            'partenaires',
            'temoignages',
            'sections',
        ]);

        return view('web.pages.solutions.solution', compact('solution'));
    }
}
