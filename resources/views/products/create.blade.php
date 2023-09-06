@extends('layouts.app')
@section('title', 'Crear Productos')

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
                                        <h6 class="text-white text-capitalize ps-3">Crear Productos</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <form action="{{route('products.store')}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label for="marca" class="form-label">Marca</label>
                                                            <input type="text" class="form-control" id="marca"
                                                                   placeholder="Marca" name="marca"
                                                                   value="{{old('marca')}}">
                                                            @error('marca')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="piece" class="form-label">Piece</label>
                                                            <input type="text" class="form-control" id="piece"
                                                                   placeholder="Pieza" name="piece"
                                                                   value="{{old('piece')}}">
                                                            @error('piece')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price" class="form-label">Precio</label>
                                                            <input type="number" class="form-control" id="price"
                                                                   placeholder="500" name="price"
                                                                   value="{{old('price')}}">
                                                            @error('price')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Imagen</label>
                                                            <input type="file" class="form-control" id="image"
                                                                   name="image" accept="image/*">
                                                            @error('image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="moto_id" class="form-label">Moto
                                                                Compatible</label>
                                                            <select class="form-select js-example-basic-multiple"
                                                                    aria-label="Seleccionar Categoria de la Moto"
                                                                    name="moto_id[]" multiple="multiple">
                                                                <option>Seleccione una opcion</option>
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
                                                            <label for="category_id"
                                                                   class="form-label">Categoria</label>
                                                            <select class="form-select"
                                                                    aria-label="Seleccionar Categoria de la Moto"
                                                                    name="category_id">
                                                                <option selected>Seleccione una opcion</option>
                                                                @foreach($categories as $category)
                                                                    <option
                                                                        value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-primary">Guardar
                                                            </button>
                                                            <a href="{{route('products.index')}}"
                                                               class="btn btn-danger text-white">Cancelar</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h6 class="text-center">Imagen</h6>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div id="preview" class="text-center">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <script type="text/javascript">
                                                                document.getElementById("image").onchange = function (e) {
                                                                    let reader = new FileReader();

                                                                    reader.readAsDataURL(e.target.files[0]);

                                                                    reader.onload = function () {
                                                                        let preview = document.getElementById('preview'),
                                                                            image = document.createElement('img');

                                                                        image.src = reader.result;

                                                                        // redimensionamos la imagen
                                                                        image.width = 250;
                                                                        image.height = 250;
                                                                        preview.innerHTML = '';
                                                                        preview.append(image);
                                                                    };
                                                                }
                                                                $(document).ready(function () {
                                                                    $('.js-example-basic-multiple').select2();
                                                                });
                                                            </script>
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
