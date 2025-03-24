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
        $curations = Curation::latest()->take(5)->get(); // 最新5件のキュレーションを取得
        return view('pages.home', compact('categories', 'curations'));
    }
}
