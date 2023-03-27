<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request -> validate([
            'feed_id' => 'required|exist:feeds,id',
            'comment_content' => 'required'
        ]);
    }
}
