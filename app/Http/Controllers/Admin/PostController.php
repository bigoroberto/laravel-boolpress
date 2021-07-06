<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
//use Illuminate\Support\Str;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index' , compact('posts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    /* seguire il suggerimento per il PostRequest in modo tale da eseguire il collegamento
    "use App\Http\Requests\PostRequest;" */
    {
        $data = $request->all();
        //dd($data);        #usiamo dd o var dump per vedere cosa succede quando inviamo i dati
        $data['slug'] = Str::slug($data['title'],'-');
        $slug_exist = Post::where('slug',$data['slug'])->first();
        $counter = 0;
        while($slug_exist){                 /* fintanto che esiste uno slug ne genero un'altro. In questo modo evito che ci siano due slug uguali */
            $title = $data['title'] . '-' . $counter;
            $data['slug'] = Str::slug($title, '-');
            $slug_exist = Post::where('slug',$data['slug'])->first();
            $counter++;
        }
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();

        //se esiste la chiave 'tags' dentro $data ed esiste solo se ho checkato qualcosa
        if(array_key_exists('tags', $data)){
            //popolo la tabella pivot con la chiave del post e le chiavi dei tags
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(!$post){
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        $categories = Category::all();
        if(!$post){
            abort(404);
        }
        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->all();

        if ($post->title !== $data['title']) {
            $slug = Str::slug($data['title'], '-'); // Lo slug è una forma leggibile e valida per l’URL di un post o di una pagina web. Serve per la SEO
            $slug_exist = Post::where('slug', $slug)->first(); //cerca se esiste uno slug
            $counter = 0; // contatore iniziale
            while ($slug_exist) { // fintanto che esiste evito che ci siano due slug uguali
                $title = $data['title'] . '-' . $counter;
                $slug = Str::slug($title, '-');
                $data['slug'] = $slug;
                $slug_exist = Post::where('slug', $slug)->first();
                $counter++;
            }
        } else {
            $data['slug'] = $post->slug;
        }

        // $data = $request->all();

        // $data['slug'] = Str::slug($post->title, '-'); // slug;
                //se esiste la chiave 'tags' dentro $data ed esiste solo se ho checkato qualcosa
                if(array_key_exists('tags', $data)){
                    //popolo la tabella pivot con la chiave del post e le chiavi dei tags
                    $post->tags()->sync($data['tags']);
                }else{
                    $post->tags()->detach();
                }

        $post->update($data);

        return redirect()->route('admin.posts.show', $post);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }
}
