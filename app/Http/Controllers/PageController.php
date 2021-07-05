<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//controller pubblico che punta la cartella guest

class PageController extends Controller
{
    public function index(){
        return view('guest.home');
    }

}
