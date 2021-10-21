<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function store(Post $post, Request $request)
    {
        // dd($post->likedBy($request->user()));

        // Poderiamos fazer da seguinte maneira: receber um ID no método durante a requisição, buscar o Post no banco
        // de dados e depois criar o objeto dentro do Banco de dados.
        // $post = Post::find($id);
        // $post->likes()->create([
        //     'user_id' => $request->user()->id,
        //     'post_id' => $post->id
        // ]);

        if ($post->likedBy($request->user())) {
            return response(null, 409); // Conflict
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
            'post_id' => $post->id
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        // dd($post);
        $request->user()
            ->likes()
            ->where('post_id', $post->id)
            ->delete();

        return back();
    }
}
