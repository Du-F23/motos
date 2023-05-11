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
                                        <h6 class="text-white text-capitalize ps-3">Crear Moto</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <form action="{{route('motos.store')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Marca</label>
                                                        <input type="text" class="form-control" id="name"
                                                               placeholder="Itallika" name="name"
                                                            value="{{old('name')}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="model" class="form-label">Modelo</label>
                                                        <input type="text" class="form-control" id="model"
                                                               placeholder="RT200 GP" name="model" value="{{old('model')}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="year" class="form-label">Año</label>
                                                        <select class="form-select"
                                                                aria-label="Seleccionar Año de fabricación de la Moto" name="year">
                                                            <option selected>Seleccione una opcion</option>
                                                            <option value="2002">2002</option>
                                                            <option value="2003">2003</option>
                                                            <option value="2004">2004</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="cilindraje" class="form-label">Cilindraje</label>
                                                        <input type="text" class="form-control" id="cilindraje"
                                                               placeholder="200 C.C." name="hp" value="{{old('hp')}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="color" class="form-label">Color</label>
                                                        <input type="text" class="form-control" id="color"
                                                               placeholder="Azul Metalico" name="color" value="{{old('color')}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Imagen</label>
                                                        <input type="file" class="form-control" id="image" name="image">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="category_id" class="form-label">Categoria</label>
                                                        <select class="form-select"
                                                                aria-label="Seleccionar Categoria de la Moto" name="category_id">
                                                            <option selected>Seleccione una opcion</option>
                                                            @foreach($categories as $category)
                                                                <option
                                                                    value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                        <a href="{{route('motos.index')}}" class="btn btn-danger text-white">Cancelar</a>
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
