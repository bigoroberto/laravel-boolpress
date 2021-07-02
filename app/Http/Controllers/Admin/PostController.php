<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
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

        return view('admin.posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
    /*     $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:3',
        ]); */

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'],'-');

        $slug_exist = Post::where('slug',$data['slug'])->first();
        $counter = 0;
        while($slug_exist){
            $title = $data['title'] . '-' . $counter;
            $slug = Str::slug($title,'-');
            $data['slug'] = $slug;
            $slug_exist = Post::where('slug',$slug)->first();
            $counter++;
        }

        $data['slug'] = Str::slug($data['title'],'-');
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();
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
        if(!$post){
            abort(404);
        }
        return view('admin.posts.edit', compact('post'));
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


        if($post->title !== $data['title']){

            $slug = Str::slug($data['title'], '-');
            $slug_exist = Post::where('slug',$slug)->first();
            $counter = 0;
            while($slug_exist){
                $title = $data['title'] . '-' . $counter;
                $slug = Str::slug($title,'-');
                $data['slug'] = $slug;
                $slug_exist = Post::where('slug',$slug)->first();
                $counter++;
            }
        }else{
            $data['slug'] = $post->slug;
        }
        //dd($data)
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
