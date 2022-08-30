<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $year = $request->birth_year?$request->birth_year:'';
        $month = $request->birth_month?$request->birth_month:'';

        if($request->birth_year && !$request->birth_month){
            $persons = DB::table('person')->whereYear('birthday', '=', $year)->paginate(20);
        }elseif(!$request->birth_year && $request->birth_month){
            $persons = DB::table('person')->whereMonth('birthday', '=', $month)->paginate(20);
        }elseif($request->birth_year && $request->birth_month){
            $persons = DB::table('person')->whereYear('birthday', '=', $year)->whereMonth('birthday', '=', $month)->paginate(20);
        }else{
            $persons = DB::table('person')->paginate(20);
        }

        return view('welcome', ['persons' => $persons]);
    }

    public function filter(){
        $year = '1971';
        $persons = DB::table('person')->whereYear('birthday', '=', $year)->paginate(20); 
        return view('welcome', ['persons' => $persons]);

        // $post = DB::whereYear('created_at', '=', $year)
        //       ->whereMonth('created_at', '=', $month)
        //       ->get();
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
