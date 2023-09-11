@extends('layouts.app')
@section('title', 'Filtrar Servicios por Usuarios')

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
                                            <h4 class="text-center text-white">Servicios</h4>
                                        </div>
                                        <div class="col-4">
                                            <form enctype="multipart/form-data" method="get"
                                                  action="{{ route('services.search') }}">
                                                <input type="text" class="form-control" id="query"
                                                       placeholder="Luis Eduardo Tenorio Flores" name="query">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" id="showMotosByCategory">
                                    @foreach($users as $user)
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{asset('storage').'/'.$user->motos->image}}" class="card-img-top"
                                                 alt="{{$user->motos->name}}">
                                            <div class="card-body">
                                                <h3 class="fw-bold">Dueño: {{$user->user}}</h3>
                                                <br>
                                                <h5 class="card-title">Moto: {{$user->motos->name}}&nbsp;{{$user->motos->model}}</h5>
                                                <p>Fecha de Servicio: {{\Carbon\Carbon::parse($user->date_service)->format('D, d/m/y')}}</p>
                                                <span>
                                                    Piezas Cambiadas:
                                                    @foreach($user->products as $piece)
                                                        {{$piece->marca}} {{$piece->piece}}
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                        <br>
                                                    @endforeach
                                                </span>
                                                <br>
                                                @if(\Carbon\Carbon::parse($user->date_service)->diffInDays(\Carbon\Carbon::now()) <= 15)
                                                    <label class="badge badge-success">En Garantia</label>
                                                @else
                                                    <label class="badge badge-danger">Fuera de Garantia</label>
                                                @endif
                                                <br>
                                                <br>
                                                <span>
                                                   Costo Servicio: $ {{$user->costo_servicio}}
                                                </span>
                                                <br>
                                                <span>
                                                    Total: $ {{$user->total}}
                                                </span>
                                                <br>
                                                <br>
                                                <a href="{{ route('services.show', Vinkla\Hashids\Facades\Hashids::encode($user->id)) }}"
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
