<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoApiController extends Controller
{
    //get all video
    public function getAllVideo()
    {
        $videos = Video::all();
        return response()->json([
            'videos' => $videos,
        ]);
    }
}
