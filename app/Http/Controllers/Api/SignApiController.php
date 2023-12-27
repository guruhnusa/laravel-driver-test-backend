<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sign;
use Illuminate\Http\Request;

class SignApiController extends Controller
{
    //get Signs by category
    public function getSignsByCategory(Request $request)
    {
        $signs = Sign::where('category', $request->category)->get();

        return response()->json([
            'signs' => $signs,
        ]);
    }

    //lalu penggunaanya bagaiamn?
    //kita bisa mengaksesnya dengan menggunakan url http://localhost:8000/api/get-signs?category=Signs
}
