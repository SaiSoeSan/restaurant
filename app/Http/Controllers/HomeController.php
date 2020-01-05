<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Restaurant::all();
        return view('index')->with('data',$data);
    }

    public function searchRestaurant(Request $request)
    {
        $resturants = Restaurant::select('*')->get();
        return $resturants;
    }

    public function calculate(Request $request)
    {
        $rest_id = $request->rest_id;
        $data = Restaurant::find($rest_id);
        return $data;
    }

    public function direction()
    {
        return view('direction');
    }
}
