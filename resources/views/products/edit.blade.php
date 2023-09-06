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
                                        <h6 class="text-white text-capitalize ps-3">Actualizar Productos</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <form
                                                action="{{route('products.update', Vinkla\Hashids\Facades\Hashids::encode($product->id))}}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="marca" class="form-label">Marca</label>
                                                            <input type="text" class="form-control" id="marca"
                                                                   placeholder="Marca" name="marca"
                                                                   value="{{$product->marca}}">
                                                            @error('marca')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="piece" class="form-label">Piece</label>
                                                            <input type="text" class="form-control" id="piece"
                                                                   placeholder="Pieza" name="piece"
                                                                   value="{{$product->piece}}">
                                                            @error('piece')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price" class="form-label">Precio</label>
                                                            <input type="number" class="form-control" id="price"
                                                                   placeholder="500" name="price"
                                                                   value="{{$product->price}}">
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
                                                                    name="moto_id[]" multiple="multiple" id="moto_id">
                                                                @foreach($motos as $moto)
                                                                    <option value="{{$moto->id}}"
                                                                        {{ $motosSelecteds->contains($moto->id) ? 'selected' : '' }}>
                                                                        {{$moto->name}} {{$moto->model}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('moto_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                        <label for="category_id" class="form-label">Categoria</label>
                                                        <select class="form-select"
                                                                aria-label="Seleccionar Categoria de la Moto" name="category_id">
                                                            @foreach($categories as $category)
                                                                <option
                                                                    value="{{$category->id}}" {{ $product->category->id == $service->$category_id ? 'selected' : '' }}>{{$category->name}}</option>
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
                                                            <script>
                                                                $(document).ready(function () {
                                                                    // Obtener los valores preseleccionados desde el controlador
                                                                    var preselectedValues = @json($motosSelecteds); // Asegúrate de que esta variable esté disponible en la vista

                                                                    // Establecer los valores preseleccionados
                                                                    $('#moto_id').val(preselectedValues).trigger('change');
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
