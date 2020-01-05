@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card">
                <form method="post" action="/restaurant" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header bg-info">
                        <h5>Add Restaurant Form</h5>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="Name">Restaurant Name:*</label>
                                    <input type="text" class="form-control" name="restaurant_name" id="restaurant_name" placeholder="Enter Restaurant Name" >
                                </div>
                                <div class="col-md-6">
                                    <label for="Name">Address:*</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="lat">Latitude:*</label>
                                    <input type="text" class="form-control" name="lat" id="lat" placeholder="Enter Latitude">
                                </div>
                                <div class="col-md-6">
                                    <label for="long">Longitude:</label>
                                    <input type="text" class="form-control" name="long" id="long" placeholder="Enter Longitude" >
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                            <button type="submit" class="btn-info btn btn-sm float-right">Add Restaurant</button>
                            <a href="/restaurant" class="btn btn-danger btn-sm mr-3">Cancel</a>
                    </div>
                </form>
                </div>
            </div>      
        </div>
    </div>
@endsection

