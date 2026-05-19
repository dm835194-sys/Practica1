<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Importamos el modelo Post
use App\Http\Requests\StorePostRequest; // Importamos el Form Request que creaste

class PostController extends Controller
{
    public function store(StorePostRequest $request)
    {
        // Creamos el post asociado automáticamente al usuario que inició sesión
        $post = auth()->user()->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
        ]);

        // Si el formulario envió etiquetas, las guardamos en la tabla pivote
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        // Nota: asume que crearás la ruta posts.show en el futuro
        return redirect()->route('dashboard')->with('success', 'Post creado exitosamente');
    }

    public function update(StorePostRequest $request, Post $post)
    {
        // Se ejecuta la Policy para autorizar que el usuario pueda editar este post
        \Gate::authorize('update', $post); 

        // Actualizamos los datos del post usando la información ya validada
        $post->update($request->validated());
        
        // Sincronizamos las etiquetas (elimina las que ya no están y agrega las nuevas)
        $post->tags()->sync($request->tags);

        return redirect()->route('dashboard')->with('success', 'Post actualizado');
    }
}