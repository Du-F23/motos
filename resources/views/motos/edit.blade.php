@extends('layouts.app')
@section('title', 'Editar Motos')

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
                                        <h6 class="text-white text-capitalize ps-3">Editar Moto</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <form action="{{route('motos.update', Vinkla\Hashids\Facades\Hashids::encode($moto->id))}}" method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nombre</label>
                                                            <input type="text" class="form-control" id="name"
                                                                   placeholder="Italika" name="name"
                                                                   value="{{$moto->name}}">
                                                            @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="model" class="form-label">Modelo</label>
                                                            <input type="text" class="form-control" id="model"
                                                                   placeholder="RT200 GP" name="model"
                                                                   value="{{$moto->model}}">
                                                            @error('model')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="year"
                                                                   class="form-label">Año {{ $moto->year }}</label>
                                                            <select class="form-select"
                                                                    aria-label="Seleccionar Año de fabricación de la Moto"
                                                                    name="year">
                                                                <option value="{{$moto->year}}">Seleccione una opcion</option>
                                                                <option value="2002">2002</option>
                                                                <option value="2003">2003</option>
                                                                <option value="2004">2004</option>
                                                            </select>
                                                            @error('year')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cilindraje"
                                                                   class="form-label">Cilindraje</label>
                                                            <input type="text" class="form-control" id="cilindraje"
                                                                   placeholder="200 C.C." name="hp"
                                                                   value="{{ $moto->hp }}">
                                                            @error('hp')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="color" class="form-label">Color</label>
                                                            <input type="text" class="form-control" id="color"
                                                                   placeholder="Azul Metalico" name="color"
                                                                   value="{{ $moto->color }}">
                                                            @error('color')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Imagen</label>
                                                            <br>
                                                            <img class="img-fluid"
                                                                 src="{{ asset('storage/'.$moto->image) }}"
                                                                 alt="{{ $moto->name }}"/>
                                                            <br>
                                                            <input type="file" class="form-control" id="image"
                                                                   name="image" accept="image/*">
                                                            @error('image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="category_id"
                                                                   class="form-label">Categoria: {{ $moto->category->name }}</label>
                                                            <select class="form-select"
                                                                    aria-label="Seleccionar Categoria de la Moto"
                                                                    name="category_id">
                                                                <option value="{{$moto->category_id}}">Seleccione una opcion</option>
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
                                                            <a href="{{route('motos.index')}}"
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
