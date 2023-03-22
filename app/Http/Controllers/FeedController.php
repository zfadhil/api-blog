<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(){
        $posts = Feed::all();
        return response()->json($posts);
    }
}
