<?php

namespace App\Http\Controllers;

use App\Models\Sign;
use Illuminate\Http\Request;

class SignController extends Controller
{
    public function index()
    {
        $signs = Sign::paginate(10);
        return view('pages.signs.index', compact('signs'));
    }
}
