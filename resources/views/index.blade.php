@extends('master')
@section('content')
    <div class="container">
        <div class="row mb-3">
          <div class="col-md-2">  
          </div>
            <div class="col-md-10">
              <form id="myform">
                <div class="row">
                  <div class="col-md-6">
                    <select name="" id="restaurant_id" class="form-control custom-select" required>
                        <option value="">Choose Restaurant</option>
                        @foreach ($data as $item)
                            <option value="{{$item->id}}">{{$item->restaurant_name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <input type="submit" class="btn btn-success" id="calculate" name="calculate" value="Calculate Distance">
                    <a href="/" class="btn btn-warning">Clear</a>
                  </div>
                  <input type="hidden" name="lat" id="hidden_lat">
                  <input type="hidden" name="lng" id="hidden_lng">
                </div>
              </form>
            </div>
        </div>
        <div class="row">
          <div class="col-md-8 offset-md-2">
           {{-- <p>The distance between Current Location and <span  id="res_name"></span> is <span id="distance_km"></span> km. </p> --}}
           <div class="alert alert-success" role="alert" id="alt_msg" style="font-size:18px;display:none;">
            The distance between Current Location and <span class="font-weight-bold" id="res_name"></span> is <span class="font-weight-bold" id="distance_km"></span> km.
          </div>
          </div>
        </div>
        <div class="row">
           <div class="col-md-12">
             <div id="floating-panel" style="display:none;">
            <b>Mode of Travel: </b>
            <select id="mode">
              <option value="DRIVING">Driving</option>
              <option value="WALKING">Walking</option>
              <option value="BICYCLING">Bicycling</option>
              <option value="TRANSIT">Transit</option>
            </select>
            </div>
                <div id="map"></div>
           </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
         #map {
            height: 400px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }
        #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
@endpush




