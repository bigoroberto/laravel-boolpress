<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;      # <-----------  importare

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        //dump($user);
        #dd($user->name);

        return view('admin.home');
    }
}
