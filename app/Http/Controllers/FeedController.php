<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Http\Resources\FeedResource;
use App\Http\Resources\FeedDetailResource;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(){
        $posts = Feed::all();
        // return response()->json($posts);
        // return response()->json(['data' => $posts]);
        return FeedResource::collection($posts);
    }

    public function show($id){
        $post = Feed::findOrFail($id);
        return new FeedDetailResource($post);
    }
}
