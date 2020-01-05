@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="float-left my-1">Restaurant List</h5>
                    <div class="float-right">
                        <a href="/restaurant/create" class="btn btn-success btn-sm">Add New Restaurant</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{$message}}</p>
                        </div>
                    @endif
                        <div class="row justify-content-between">
                            <div class="col-md-4 col-xs-12">
                                <a href="/restaurant" class="btn btn-md btn-success btn-sm">All Data</a> 
                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <form action="/restaurant" method="get" role="search" class="form-inline">
                                        <input class="text mr-2 form-control" type="search" placeholder="Search" aria-label="Search" name="search_name" autocomplete="off" value="{{$search_name}}">
                                        <button class="btn btn-success btn-sm p-2" type="submit">Search</button>
                                      </form>
                                </div>
                            </div>
                        </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Restaurant Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Latitude</th>
                                <th>Longitude</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($data) == 0)
                            <tr class="text-danger">
                                <td colspan="5" role="alert" class="alert alert-danger text-center">There is no data</td>
                            </tr>
                        @else
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$item->restaurant_name}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->lat}}</td>
                                <td>{{$item->long}}</td>
                                <td>
                                    <a href="/restaurant/{{$item->id}}/edit" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                    <form action="/restaurant/{{$item->id}}" class="d-inline" method="post" onsubmit="return confirm('Are you sure to delete?')">
                                        @csrf
                                        @method('DELETE ')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @if (count($data) > 0)
                        <div class="float-right">
                            {{$data->appends(request()->input())->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection