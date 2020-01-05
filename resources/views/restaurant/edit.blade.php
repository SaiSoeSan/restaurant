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
                <form method="post" action="/restaurant/{{$data->id}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-header bg-info">
                        <h5>Edit Restaurant Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="restaurant_name">Restaurant Name:*</label>
                                <input type="text" class="form-control" name="restaurant_name" id="restaurant_name" placeholder="Enter Restaurant Name" value="{{$data->restaurant_name}}">
                            </div>
                            <div class="col-md-6">
                                <label for="address">Address:*</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="{{$data->address}}">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="lat">Latitude:*</label>
                                <input type="text" class="form-control" name="lat" id="lat" placeholder="Enter Latitude" value="{{$data->lat}}">
                            </div>
                            <div class="col-md-6">
                                <label for="long">Longitude:</label>
                                <input type="text" class="form-control" name="long" id="long" placeholder="Enter Longitude" value="{{$data->long}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn-info btn btn-sm float-right">Update Restaurant</button>
                        <a href="/restaurant" class="btn btn-danger btn-sm mr-3">Cancel</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('summernote/summernote-bs4.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('summernote/summernote-bs4.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Enter Description'
            });
        });
    </script>
@endpush