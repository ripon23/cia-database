<?php

namespace App\Http\Controllers; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
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
        //DB::connection()->enableQueryLog();  // For query execution time debug
        
        $cached_expire = 60;        // User choice, cache expire in 60 second

        /************************ Check any filter apply  *******************/
        if($request->birth_year || $request->birth_month){                                    
            /****** Query in database first time withour page key ******/
            if($request->birth_year && !$request->birth_month){                               
                /***** Only YEAR filter *****/
                $persons = Cache::remember('persons_year_'.$request->birth_year, $cached_expire, function () use ($request) {
                    return DB::table('person')->whereYear('birthday', '=', $request->birth_year)->get()->toArray();
                });
                
            }elseif(!$request->birth_year && $request->birth_month){
                /***** Only MONTH filter *****/
                $persons = Cache::remember('persons_month_'.$request->birth_month, $cached_expire, function () use ($request) {
                    return DB::table('person')->whereMonth('birthday', '=', $request->birth_month)->get()->toArray();
                });
                               
            }elseif($request->birth_year && $request->birth_month){
                /***** BOTH YEAR & MONTH filter *****/
                $persons = Cache::remember('persons_year_'.$request->birth_year.'_month_'.$request->birth_month, $cached_expire, function () use ($request) {
                    return DB::table('person')->whereYear('birthday', '=', $request->birth_year)->whereMonth('birthday', '=', $request->birth_month)->get()->toArray();
                });
             
            }else{
                /****** No filter *****/
                $persons = DB::table('person')->get()->toArray();;                    
            }                
                            
        }else{
            /****** No filter *****/
            $persons = DB::table('person')->get()->toArray();;
        }        

        //print_r(DB::getQueryLog()); // For query execution time debug

        /**** Pagination must retrieve data from Redis cache if it is available. ****/
        $persons = $this->arrayPaginator($persons, $request); // Paginate the result
        return view('welcome')->with('persons', $persons);;
    }

    /***** Custom pagination method *****/
    public function arrayPaginator($array, $request)
    {
        $page =  $request->get('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }

}