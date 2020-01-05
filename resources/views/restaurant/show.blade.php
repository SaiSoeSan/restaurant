@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="float-left my-1">Movie Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 col-sm-6 col-xs-6">Movie Name</div>
                        <div class="col-8 col-sm-6 col-xs-6">{{$data->movie_name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-sm-6 col-xs-6">Release Year</div>
                        <div class="col-8 col-sm-6 col-xs-6">{{$data->release_year}}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-sm-6 col-xs-6">Genre</div>
                        <div class="col-8 col-sm-6 col-xs-6">{{$data->genre_id}}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-sm-6 col-xs-6">Rating</div>
                        <div class="col-8 col-sm-6 col-xs-6">{{$data->rating_id}}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-sm-6 col-xs-6">Format</div>
                        <div class="col-8 col-sm-6 col-xs-6">{{$data->format}}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-sm-6 col-xs-6">Description</div>
                        <div class="col-8 col-sm-6 col-xs-6">{!!$data->description!!}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-sm-6 col-xs-6">Image</div>
                        <div class="col-8 col-sm-6 col-xs-6">
                            <img src="{{ URL::to('/') }}/images/{{$data->image}}" alt="movie_photo" class="img-thumbnail" width="50%">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mr-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection