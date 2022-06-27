<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('unseen.notifications');
    }
    public function index()
    {
        return view('home.index');


        User::lazyById();
    }
}
