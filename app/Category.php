<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // se faccio una query così: $category = Category::find($id);
    // alla proprietà $category->posts voglio avere un array dei post in relazione

    public function posts(){
        //restituisce un array di entità
        return $this->hasMany('App\Post');
    }
}
