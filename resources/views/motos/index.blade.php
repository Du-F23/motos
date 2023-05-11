@extends('layouts.app')
@section('title', 'Motos')

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
                                        <h6 class="text-white text-capitalize ps-3">Lista De Categorias</h6>
                                        <div class="float-end">
                                            {{-- Button del modal --}}
                                            <a href="{{route('motos.create')}}" class="btn btn-primary" title="Agregar">
                                                <i class="mdi mdi-plus-circle-outline"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table" id="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Modelo</th>
                                                    <th>Año</th>
                                                    <th>Cilindraje</th>
                                                    <th>Color</th>
                                                    <th>Categoria</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($motos as $moto)
                                                    <tr>
                                                        <td>{{$loop->index + 1}}</td>
                                                        <td>{{$moto->name}}</td>
                                                        <td>{{$moto->model}}</td>
                                                        <td>{{$moto->year}}</td>
                                                        <td>{{$moto->hp}}</td>
                                                        <td>{{$moto->color}}</td>
                                                        <td>{{$moto->category->name}}</td>
                                                        <td>
                                                            <a type="button"
                                                               href="{{route('motos.edit', $moto->id)}}"
                                                               class="btn btn-primary btn-sm">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            {{--                                                            <a href="{{route('categories.destroy', $category->id)}}"--}}
                                                            {{--                                                               class="btn btn-danger btn-sm">--}}
                                                            {{--                                                                <i class="mdi mdi-delete"></i>--}}
                                                            {{--                                                            </a>--}}
                                                            <form
                                                                action="{{route('motos.destroy', $moto->id)}}"
                                                                method="POST">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button class="btn btn-danger btn-sm"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal2"
                                                                        data-bs-placement="top"
                                                                        title="Eliminar"
                                                                        type="submit"
                                                                        onclick="return confirm('¿Estas seguro de eliminar este registro? {{$moto->name}}')"
                                                                >
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                            categorias borradas--}}
                        {{--                        si motosDeleted no contiene nada no muestra nada si si contiene algo muestra la tabla--}}
                        @if($motosDeleted->count() !== 0)
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                        <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                            <h6 class="text-white text-capitalize ps-3">Lista De Motos Eliminadas</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table" id="table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre</th>
                                                        <th>Modelo</th>
                                                        <th>Año</th>
                                                        <th>Cilindraje</th>
                                                        <th>Color</th>
                                                        <th>Categoria</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($motosDeleted as $moto)
                                                        <tr>
                                                            <td>{{$loop->index + 1}}</td>
                                                            <td>{{$moto->name}}</td>
                                                            <td>{{$moto->model}}</td>
                                                            <td>{{$moto->year}}</td>
                                                            <td>{{$moto->hp}}</td>
                                                            <td>{{$moto->color}}</td>
                                                            <td>{{$moto->category->name}}</td>
                                                            <td>
                                                                {{--                                                            <a type="button"--}}
                                                                {{--                                                               href="{{route('categories.edit', $category->id)}}"--}}
                                                                {{--                                                               class="btn btn-primary btn-sm">--}}
                                                                {{--                                                                <i class="mdi mdi-pencil"></i>--}}
                                                                {{--                                                            </a>--}}
                                                                <form action="{{route('motos.restore', $moto->id)}}"
                                                                      method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button class="btn btn-rounded-success btn-sm"
                                                                            title="Restore"
                                                                            type="submit"
                                                                            onclick="return confirm('¿Estas seguro de reactivar este registro? {{$category->name}}')"
                                                                    >
                                                                        <i class="mdi mdi-backup-restore"></i>
                                                                    </button>

                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
