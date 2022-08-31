<?php

namespace App\Http\Controllers; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //DB::connection()->enableQueryLog();  // For debug
        $year = $request->birth_year?$request->birth_year:'';
        $month = $request->birth_month?$request->birth_month:'';

        $page = request()->has('page') ? request()->get('page') : 1;
        // from user's preferences
        $perPage = 20;

        /************************ Check in Redis  *******************/
        if($request->birth_year || $request->birth_month){
            $redis = app()->make('redis');
            $redis_birth_year = $redis->get("birth_year");
            $redis_birth_month = $redis->get("birth_month");

            if($redis_birth_year == $year && $redis_birth_month ==$month){
                //Cache exist                               
            }else{
                // No cache available
                $redis->set("birth_year", $year,'EX', 60);
                $redis->set("birth_month", $month, 'EX', 60);
            }
                                    
            // Query in database
            if($request->birth_year && !$request->birth_month){                               
                
                $persons = Cache::remember('persons_year_'.$request->birth_year.'_pp_'. $perPage.'_p_'.$page, 60, function () use ($request, $perPage, $page) {
                    return DB::table('person')->whereYear('birthday', '=', $request->birth_year)->paginate($perPage, ['*'], 'page', $page);
                });
                
            }elseif(!$request->birth_year && $request->birth_month){

                $persons = Cache::remember('persons_month_'.$request->birth_month.'_pp_'. $perPage.'_p_'.$page, 60, function () use ($request, $perPage, $page) {
                    return DB::table('person')->whereMonth('birthday', '=', $request->birth_month)->paginate($perPage, ['*'], 'page', $page);
                });
                               
            }elseif($request->birth_year && $request->birth_month){

                $persons = Cache::remember('persons_year_'.$request->birth_year.'_month_'.$request->birth_month.'_pp_'. $perPage.'_p_'.$page, 60, function () use ($request, $perPage, $page) {
                    return DB::table('person')->whereYear('birthday', '=', $request->birth_year)->whereMonth('birthday', '=', $request->birth_month)->paginate($perPage, ['*'], 'page', $page);
                });
             
            }else{

                $persons = DB::table('person')->paginate($perPage);                    
            }                
                            
        }else{
            $persons = DB::table('person')->paginate($perPage);
        }        

        //print_r(DB::getQueryLog()); // For debug
        return view('welcome', ['persons' => $persons]);
    }
}