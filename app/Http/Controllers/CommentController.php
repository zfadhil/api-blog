<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request -> validate([
            'feeds_id' => 'required|exists:feeds,id',
            'comments_content' => 'required'
        ]);

        $request['user_id'] = auth()->user()->id;

        $comment = Comment::create($request->all());

        return response()->json($comment);
        // return response()->json($comment);

        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comments_content' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->only('comments_content'));

        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }

    public function delete($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return new CommentResource($comment->loadMissing(['commentator:id,username']));
    }
}
