<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    //all'interno del controller faremo una query di questo tipo:
    // $post = Post::find($id)
    // $posts->category   <----- in questo modo ho il risultato della relazione
    // per ottenere questo risultato devo creare questa funzione:

    public function category(){
        //mi restituisce una singola entità
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany(('App\Tag'));
    }
}
