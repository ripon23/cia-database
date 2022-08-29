<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $persons = DB::table('person')->offset(0)->limit(30)->get();
 
        //return view('user.index', ['users' => $users]);
        return view('welcome', ['persons' => $persons]);
    }

    // public function redirectPage(){
    //     if(Cookie::has('prefix')){
    //         return redirect(Cookie::get('prefix').'/login');
    //     }
        
    // }

    // public function redirectPageWithPrefix($prefix){
    //     return redirect($prefix.'/login');
    // }
}
