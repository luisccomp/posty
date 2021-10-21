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
        $posts = Post::with(['user', 'likes'])->paginate(15);

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
        dd($post);
    }
}
