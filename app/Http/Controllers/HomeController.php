<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       
        return view('home');
    }
        public function admin()
    {
        if(!Gate::allows('isAdmin')){
            abort(404,"Sorry, You can't do this actions");
        }
        return "hye admin :D ";
    }
}
