<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curation;

class CurationController extends Controller
{
    public function index()
    {
        $curations = Curation::all();
        return view('curations.index', compact('curations'));
    }
}
