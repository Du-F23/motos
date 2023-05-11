@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="card">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 align-content-md-center">
                                <div
                                    class="bg-gradient-primary shadow-primary rounded pt-4 pb-3 align-content-md-center">
                                    <div class="row">
                                        <div class="col-4">
                                            <h4 class="text-center text-white">Motos</h4>
                                        </div>
                                        <div class="col-4">
                                            <select class="form-control" aria-label="Default select example" id="category">
                                                <option selected>Selecciona una categoria</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($motos as $moto)
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{asset('storage').'/'.$moto->image}}" class="card-img-top"
                                                 alt="{{$moto->name}}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$moto->name}}</h5>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
