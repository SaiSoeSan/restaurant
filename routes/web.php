<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Marker
// Route::get('/',function(){
//     $config['center'] = 'Serangoon, Singapore';
//     $config['zoom'] = '13';
//     $config['max_height'] = '500px';
//     $config['geocodeCaching'] = true;
//     // $config['max_width'] = '500px';
//     $config['scrollwheel'] = false;

//     GMaps::initialize($config);

//     // Add Marker
//     $marker['position'] = 'Serangon, Singapore';
//     $marker['infowindow_content'] = 'Serangon';
//     Gmaps::add_marker($marker);

//     // Add Marker
//     $marker['position'] = 'Hougang, Singapore';
//     $marker['infowindow_content'] = 'Hougang';
//     // $marker['icon'] = 'http://maps.google.com/mapfiles/kml/paddle/grn-circle.png';
//     Gmaps::add_marker($marker);


//     $map = GMaps::create_map();

//     return view('index')->with('map',$map);
// });

// Direction
// Route::get('/direction',function(){
//     $config['center'] = 'Serangoon, Singapore';
//     $config['zoom'] = '13';
//     $config['max_height'] = '500px';
//     $config['geocodeCaching'] = true;
//     // $config['max_width'] = '500px';
//     $config['scrollwheel'] = false;

//     $config['directions'] = true;
//     $config['directionsStart'] = 'Serangon, Singapore';
//     $config['directionsEnd'] = 'Hougang, Singapore';
//     $config['directionsDivID'] = 'directionsDiv';

//     GMaps::initialize($config);

//     // Add Marker
//     $marker['position'] = 'Serangon, Singapore';
//     $marker['infowindow_content'] = 'Serangon';
//     Gmaps::add_marker($marker);

//     // Add Marker
//     $marker['position'] = 'Hougang, Singapore';
//     $marker['infowindow_content'] = 'Hougang';
//     // $marker['icon'] = 'http://maps.google.com/mapfiles/kml/paddle/grn-circle.png';
//     Gmaps::add_marker($marker);


//     $map = GMaps::create_map();

//     return view('index')->with('map',$map);
// });


// Current
// Route::get('/current',function(){
//     $config['center'] = 'auto';
//     $config['onboundschanged'] = 'if (!centreGot) {
//         var mapCentre = map.getCenter();
//         marker_0.setOptions({
//             position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
//         });
//     }
//     centreGot = true;';

//     // dd($config);
//     GMaps::initialize($config);

//     $marker = array();
//     Gmaps::add_marker($marker);



//     $map = GMaps::create_map();

//     return view('index')->with('map',$map);
// });

// Route::get('/',function(){
//     $data = [];
//     return view('index')->with('data',$data);
// });
Route::get('/','HomeController@index');

Route::get('/searchRestaurant','HomeController@searchRestaurant');
Route::get('/calculate','HomeController@calculate');

Route::get('/direction','HomeController@direction');





Route::middleware(['auth'])->group(function () {    
    
     Route::resource('restaurant', 'RestaurantController');
 });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
