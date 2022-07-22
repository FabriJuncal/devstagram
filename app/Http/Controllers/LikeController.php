<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Reagistra el like en la tabla "likes" en la base de datos
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }
}
