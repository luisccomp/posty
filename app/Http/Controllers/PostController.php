<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // As vezes é interessante realizar uma leitura prévia dos items do banco de dados para evitar o problema
        // N + 1 e deixar o sistema lento
        $posts = Post::orderBy('created_at', 'desc')
            ->with(['user', 'likes'])
            ->paginate(20);

        // Passando a coleção de posts para a minha view
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // De forma alternativa, podemos criar posts como se fosse um modelo, mas devemos lembrar de usar a classe de
        // modelo do Eloquent ORM
        // Post::create([
        //     'body' => $request->body,
        //     'user_id' => auth()->id()
        // ]);

        $request->user()
            ->posts()
            ->create($request->only('body'));

        return back();
    }

    public function destroy(Post $post)
    {
        // Apagando o Post do banco de dados
        // if (!$post->ownedBy(auth()->user()))
        // {
        //     // Throw an exception, if a user figure ou a way to delete a post that does not belongs to him
        // }
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
