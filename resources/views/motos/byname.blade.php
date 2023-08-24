@extends('layouts.app')
@section('title', 'Editar Motos')

@section('content')
    <div class="container-scroller bg-black" id="body">
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
                                            <form enctype="multipart/form-data" method="get"
                                                  action="{{ route('motos.search') }}">
                                                <input type="text" class="form-control" id="query"
                                                       placeholder="Italika o RT200 GP" name="query">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" id="showMotosByCategory">
                                    @foreach($motos as $moto)
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{asset('storage').'/'.$moto->image}}" class="card-img-top"
                                                 alt="{{$moto->name}}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$moto->name}} {{$moto->model}}</h5>
                                                <a href="{{ route('motos.show', Vinkla\Hashids\Facades\Hashids::encode($moto->id)) }}"
                                                   class="btn btn-primary">Ver Más</a>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                    @endforeach
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
