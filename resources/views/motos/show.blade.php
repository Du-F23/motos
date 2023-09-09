@extends('layouts.app')
@section('title', 'Mostrar Motos')

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
                                        <h6 class="text-white text-capitalize ps-3">Mostrar
                                            Moto {{ $moto->name }} {{$moto->model}}</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nombre</label>
                                                        <input type="text" class="form-control" id="name"
                                                               placeholder="Italika" name="name"
                                                               value="{{$moto->name}}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="model" class="form-label">Modelo</label>
                                                        <input type="text" class="form-control" id="model"
                                                               placeholder="RT200 GP" name="model"
                                                               value="{{$moto->model}}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="year"
                                                               class="form-label">Año</label>
                                                        <input id="year" name="year" type="text" disabled
                                                               value="{{ $moto->year }}" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="cilindraje"
                                                               class="form-label">Cilindraje</label>
                                                        <input type="text" class="form-control" id="cilindraje"
                                                               placeholder="200 C.C." name="hp"
                                                               value="{{ $moto->hp }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="color" class="form-label">Color</label>
                                                        <input type="text" class="form-control" id="color"
                                                               placeholder="Azul Metalico" name="color"
                                                               value="{{ $moto->color }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="category_id"
                                                               class="form-label">Categoria</label>
                                                        <input name="category_id" id="category_id"
                                                               value="{{$moto->category->name}}" class="form-control"
                                                               disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h5 class="text-center font-bold">Imagen</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div id="preview" class="text-center">
                                                                            <div class="row">
                                                                                <div class="col-md-5">
                                                                                    <img class="card-img-top"
                                                                                         src="{{ asset('storage/'.$moto->image) }}"
                                                                                         alt="{{ $moto->name }}"/>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    Nombre:
                                                                                    <p>{{$moto->name}} {{$moto->model}}</p>
                                                                                    Año: <p>{{$moto->year}}</p>
                                                                                    Cilindraje: <p>{{$moto->hp}} CC</p>
                                                                                    Color: <p>{{$moto->color}}</p>
                                                                                </div>
                                                                                <div class="col-md-2"></div>
                                                                                <br>
                                                                                <div class="col-md-12">
                                                                                    <h3>Piezas Compatibles</h3>
                                                                                </div>
                                                                                <br>
                                                                                <br>
                                                                                <div class="accordion"
                                                                                     id="accordionExample">
                                                                                    @php $previousCategory = null @endphp
                                                                                    @php $productCount = 0 @endphp
                                                                                    @foreach($pieces as $index => $piece)
                                                                                        @if ($piece->category_id !== $previousCategory)
                                                                                            @if ($previousCategory !== null)
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header"
                                                                                id="heading{{ $index }}">
                                                                                <button class="accordion-button"
                                                                                        type="button"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#collapse{{ $index }}"
                                                                                        aria-expanded="true"
                                                                                        aria-controls="collapse{{ $index }}">
                                                                                    {{ $piece->category->name }}
                                                                                </button>
                                                                            </h2>
                                                                            <div id="collapse{{ $index }}"
                                                                                 class="accordion-collapse collapse show"
                                                                                 aria-labelledby="heading{{ $index }}"
                                                                                 data-bs-parent="#accordionExample">
                                                                                <div class="accordion-body">
                                                                                    <div class="row">
                                                                                        @endif
                                                                                        <div class="col-md-4">
                                                                                            <!-- Contenido de cada producto -->
                                                                                            <img
                                                                                                class="card-img w-50 img-fluid align-items-center align-content-center justify-content-center"
                                                                                                src="{{ asset('storage/'.$piece->image) }}"
                                                                                                alt="{{ $piece->marca }} {{$piece->piece}}"
                                                                                                width="20px"/>
                                                                                            <br>
                                                                                            <strong>Marca: {{ $piece->marca }}</strong>
                                                                                            <br>
                                                                                            <p>
                                                                                                Pieza: {{ $piece->piece }}</p>
                                                                                            <br>
                                                                                            <a href="{{ route('products.show',  Hashids::encode($piece->id)) }}">Ver
                                                                                                Pieza</a>
                                                                                        </div>
                                                                                        <!-- Cerrar el acordeón después de mostrar 3 productos -->
                                                                                        @if ($productCount === 2 || $loop->last)
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Cerrar la fila actual de productos -->
                                                                        @php $productCount = 0 @endphp
                                                                    </div>
                                                                    <!-- Cerrar el acordeón actual -->
                                                                    @else
                                                                        @php $productCount++ @endphp
                                                                    @endif
                                                                    @php $previousCategory = $piece->category_id @endphp
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
@endsection
