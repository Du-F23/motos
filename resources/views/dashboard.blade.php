@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                                            <select class="form-select" aria-label="Default select example"
                                                    id="category">
                                                <option selected>Selecciona una categoria</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <form enctype="multipart/form-data" method="get"
                                              action="{{ route('motos.search') }}" class="col-4">
                                            <input type="text" class="form-control" id="query"
                                                   placeholder="Italika o RT200 GP" name="query">
                                            <button type="submit" class="btn btn-primary">Buscar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" id="showMotosByCategory">
                                    <div class="col-sm-12 flex-column d-flex stretch-card">
                                        <div class="row">
                                            <div class="col-lg-3 d-flex grid-margin stretch-card">
                                                <div class="card bg-primary">
                                                    <div class="card-body text-white">
                                                        <h3 class="font-weight-bold mb-3">Servicios</h3>
                                                        <a href="{{route('services.create')}}" type="button" class="btn btn-primary text-center">
                                                            Crear Servicio
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 d-flex grid-margin stretch-card">
                                                <div class="card sale-diffrence-border">
                                                    <div class="card-body">
                                                        <h2 class="mb-2 font-weight-bold">Productos</h2>
                                                        <small class="text-muted card-title">{{\App\Models\Products::count()}}</small>
                                                        <br>
                                                        <br>
                                                        <a href="{{route('products.create')}}" class="btn btn-primary">Crear Producto</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 d-flex grid-margin stretch-card">
                                                <div class="card sale-visit-statistics-border">
                                                    <div class="card-body">
                                                        <h2 class="mb-2 font-weight-medium font-bold">Motos</h2>
                                                        <small class="text-muted card-title">{{\App\Models\Motos::count()}}</small>
                                                        <br>
                                                        <br>
                                                        <a href="{{route('motos.create')}}" class="btn btn-primary">Crear Motos</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 d-flex grid-margin stretch-card">
                                                <div class="card sale-diffrence-border">
                                                    <div class="card-body">
                                                        <h2 class="text-dark mb-2 font-weight-bold">$6475</h2>
                                                        <h4 class="card-title mb-2">Sales Difference</h4>
                                                        <small class="text-muted">APRIL 2019</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($motos as $moto)
                                        <div class="card" style="width: 18rem; margin: 10px;">
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
                <script type="application/javascript">
                    $(document).ready(function () {
                        $('#category').on('change', function () {
                            $.ajax({
                                url: "/motosByCategory/" + this.value,
                                type: "get",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                success: function (data) {
                                    //si la respuesta del servidor es exitosa se ejecuta esta funcion y se muestra el resultado
                                    $('#showMotosByCategory').html(data);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
