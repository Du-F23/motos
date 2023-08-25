@extends('layouts.app')
@section('title', 'Mostrar Servico')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row mt-4">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                        <h6 class="text-white text-capitalize ps-3">Mostrar Servicio a la
                                            Moto: {{ $service->motos->name }} {{$service->motos->model}}</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Cliente</label>
                                                        <input type="text" class="form-control" id="name"
                                                               name="user"
                                                               value="{{$service->user}}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Fecha de Servicio</label>
                                                        <input type="text" class="form-control" id="name"
                                                               name="date_service"
                                                               value="{{\Carbon\Carbon::parse($service->date_service)->format('D, d/m/y')}}"
                                                               disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Costo de Servicio</label>
                                                        <input type="text" class="form-control" id="name"
                                                               name="costo_servicio"
                                                               value="$ {{$service->costo_servicio}}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="total" class="form-label">Total</label>
                                                        <input type="text" class="form-control" id="total"
                                                               name="total"
                                                               value="$ {{$service->total}}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Atendio</label>
                                                        <input type="text" class="form-control" id="name"
                                                               name="user_id"
                                                               value="{{$service->users->name}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h5 class="text-center font-bold">Moto</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div id="preview" class="text-center">
                                                                            <div class="row">
                                                                                <div class="col-md-5">
                                                                                    <img class="card-img-top"
                                                                                         src="{{ asset('storage/'.$service->motos->image) }}"
                                                                                         alt="{{ $service->motos->name }}"/>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    Nombre:
                                                                                    <p>{{$service->motos->name}} {{$service->motos->model}}</p>
                                                                                    Año:
                                                                                    <p>{{$service->motos->year}}</p>
                                                                                    Cilindraje:
                                                                                    <p>{{$service->motos->hp}} CC</p>
                                                                                    Color:
                                                                                    <p>{{$service->motos->color}}</p>
                                                                                </div>
                                                                                <h3>Piezas Utlizadas</h3>
                                                                                <br>
                                                                                <br>
                                                                                @foreach($service->products  as $piece)
                                                                                    <div class="card"
                                                                                         style="width: 18rem; align-items: center; justify-content: center;">
                                                                                        <img
                                                                                            class="card-img w-50 img-fluid align-items-center align-content-center justify-content-center m-3 border-3"
                                                                                            src="{{ asset('storage/'.$piece->image) }}"
                                                                                            alt="{{ $piece->marca }} {{$piece->piece}}"
                                                                                            width="20px"/>
                                                                                        <div class="card-body">
                                                                                            <h5 class="card-title">
                                                                                                Marca: {{$piece->marca}}</h5>
                                                                                            Categoría:
                                                                                            <p>{{$piece->piece}}</p>
                                                                                            <h4>Precio: {{$piece->price}}</h4>
                                                                                        </div>
                                                                                        <div class="card-footer">
                                                                                            <a href="{{ route('products.show',  Hashids::encode($piece->id)) }}"
                                                                                               class="">Ver Pieza</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <br>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
