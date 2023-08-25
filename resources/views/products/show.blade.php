@extends('layouts.app')
@section('title', 'Mostrar Productos')

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
                                        <h6 class="text-white text-capitalize ps-3">Productos</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="marca" class="form-label">Marca</label>
                                                        <input type="text" class="form-control" id="marca"
                                                               placeholder="Marca" name="marca"
                                                               value="{{$product->marca}}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="piece" class="form-label">Piece</label>
                                                        <input type="text" class="form-control" id="piece"
                                                               placeholder="Pieza" name="piece"
                                                               value="{{$product->piece}}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="price" class="form-label">Precio</label>
                                                        <input type="number" class="form-control" id="price"
                                                               placeholder="500" name="price"
                                                               value="{{$product->price}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card" style="margin: 10px;">
                                                                    <div class="card-header">
                                                                        <h6 class="text-center">Pieza</h6>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div id="preview" class="text-center">
                                                                            <div class="row">
                                                                                <div class="col-md-5">
                                                                                    <img class="card-img-top"
                                                                                         src="{{ asset('storage/'.$product->image) }}"
                                                                                         alt="{{ $product->name }}"/>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    Nombre:
                                                                                    <p>{{$product->marca}} {{$product->piece}}</p>
                                                                                    Precio: <p>
                                                                                        $ {{$product->price}}</p>

                                                                                </div>
                                                                                <h3>Motos Compatibles</h3>
                                                                                <br>
                                                                                <br>
                                                                                @foreach($product->motos  as $moto)
                                                                                    <div class="card"
                                                                                         style="width: 18rem; align-items: center; justify-content: center;">
                                                                                        <img
                                                                                            class="card-img w-50 img-fluid align-items-center align-content-center justify-content-center m-3 border-3"
                                                                                            src="{{ asset('storage/'.$moto->image) }}"
                                                                                            alt="{{ $moto->name }}"
                                                                                            width="20px"/>
                                                                                        <div class="card-body">
                                                                                            <p class="card-title">
                                                                                                Marca: {{$moto->name}} {{$moto->model}}
                                                                                            </p>
                                                                                            <p>
                                                                                                Año: {{$moto->year}}
                                                                                            </p>
                                                                                            <p>
                                                                                                Cilindraje: {{$moto->hp}}
                                                                                                CC
                                                                                            </p>
                                                                                            <p>
                                                                                                Color: {{$moto->color}}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="card-footer">
                                                                                            <a href="{{ route('motos.show',  Hashids::encode($moto->id)) }}"
                                                                                               class="">Ver
                                                                                                Moto</a>
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
