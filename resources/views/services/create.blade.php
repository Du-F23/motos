@extends('layouts.app')
@section('title', 'Crear Motos')

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
                                        <h6 class="text-white text-capitalize ps-3">Crear Servicio</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <form action="{{route('services.store')}}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label for="user" class="form-label">Nombre del Cliente</label>
                                                            <input type="text" class="form-control" id="user"
                                                                   placeholder="Juan Perez Hermenegildo" name="user"
                                                                   value="{{old('user')}}">
                                                            @error('user')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="costo_servicio" class="form-label">Costo Servicio (Mano de Obra)</label>
                                                            <input type="number" class="form-control" id="costo_servicio"
                                                                   name="costo_servicio" value="{{old('costo_servicio')}}">
                                                            @error('hp')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="moto_id" class="form-label">Moto</label>
                                                            <select class="form-select"
                                                                    aria-label="Seleccionar Moto" name="moto_id">
                                                                <option selected>Seleccione una Moto de las Disponibles</option>
                                                                @foreach($motos as $moto)
                                                                    <option
                                                                        value="{{$moto->id}}">{{$moto->name}} {{$moto->model}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('moto_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="product_id" class="form-label">Piezas</label>
                                                            <select class="form-select js-example-basic-multiple"
                                                                    aria-label="Seleccionar Piezas a Cambiar de la Moto" name="product_id[]" multiple="multiple">
                                                                @foreach($products as $product)
                                                                    <option
                                                                        value="{{$product->id}}">{{$product->marca}} {{$product->piece}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('product_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                            <a href="{{route('services.index')}}" class="btn btn-danger text-white">Cancelar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
