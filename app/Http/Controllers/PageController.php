<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Curation;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $curations = Curation::latest()->take(5)->get();
        return view('pages.home', compact('categories', 'curations'));
    }
}
