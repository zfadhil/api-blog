<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Http\Resources\FeedResource;
use App\Http\Resources\FeedDetailResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index(){
        $posts = Feed::all();
        // return response()->json($posts);
        // return response()->json(['data' => $posts]);
        return FeedResource::collection($posts);
    }

    public function show($id){
        $post = Feed::with('writer:id,username')->findOrFail($id);
        return new FeedDetailResource($post);
    }

    public function store(Request $request){
        $request -> validate([
            'title' => 'required|max:255',
            'feeds_content' => 'required',
        ]);

        // return response()->json('sudah dapat digunakan');
        $request['author'] = Auth::user()->id;

        $post = Feed::create($request->all());
        return new FeedDetailResource($post->loadMissing('writer:id,username'));

    }

    public function update(Request $request, $id){
        $request -> validate([
            'title' => 'required|max:255',
            'feeds_content' => 'required',
        ]);

        $post = Feed::findOrFail($id);
        $post->update($request->all());

        // return response()->json('sudah dapat digunakan');
        return new FeedDetailResource($post->loadMissing('writer:id,username'));

    }
}
