<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_name = $request['search_name'];
        $data = Restaurant::select('*');
        if($search_name <> null){
            $data = $data->where('restaurant_name','LIKE','%'.$search_name.'%');
        }
        $data = $data->paginate(10);
        return view('restaurant.index')->with('data',$data)
                                        ->with('search_name',$search_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("restaurant.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_name'   =>  'required',
            'address' => 'required',
            'lat'     => 'required',
            'long'    => 'required',    
        ]);
        $restaurant = new Restaurant;
        $restaurant->restaurant_name = $request['restaurant_name'];
        $restaurant->address = $request['address'];
        $restaurant->lat = $request['lat'];
        $restaurant->long = $request['long'];

        $restaurant->save();
        return redirect('/restaurant')->with('success','Data Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Restaurant::find($id);
        return view('restaurant.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'restaurant_name'   =>  'required',
            'address' => 'required',
            'lat'     => 'required',
            'long'    => 'required',    
        ]);

        $restaurant = Restaurant::find($id);
        $restaurant->restaurant_name = $request['restaurant_name'];
        $restaurant->address = $request['address'];
        $restaurant->lat = $request['lat'];
        $restaurant->long = $request['long'];

        $restaurant->save();
        return redirect('/restaurant')->with('success','Data Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Restaurant::destroy($id);
        return redirect('/restaurant');
    }
}
