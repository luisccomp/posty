<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count())
        {
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

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
