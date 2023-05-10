@extends('layouts.app')

@section('title', 'Categorias')
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
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar">
                                                <i class="mdi mdi-plus-circle-outline"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ingrese Una Categoria
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label=""></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <form action="{{ route('categories.store') }}"
                                                              method="POST">
                                                            <div class="row">
                                                                {{-- generar el token para el envio de dato csrf --}}
                                                                {{ csrf_field() }}

                                                                <label class="col" for="">Nombre de la
                                                                    Categoria:</label>
                                                                <input id="name" class="col form-control"
                                                                       type="text" name="name" placeholder="Deportiva"
                                                                       required>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancelar
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Guardar
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table" id="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($categories as $category)
                                                    <tr>
                                                        <td>{{$loop->index + 1}}</td>
                                                        <td>{{$category->name}}</td>
                                                        <td>
                                                            @if($category->active)
                                                                <label class="badge badge-success">Activo</label>
                                                            @else
                                                                <label class="badge badge-danger">Inactivo</label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a type="button"
                                                               href="{{route('categories.edit', $category->id)}}"
                                                               class="btn btn-primary btn-sm">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            {{--                                                            <a href="{{route('categories.destroy', $category->id)}}"--}}
                                                            {{--                                                               class="btn btn-danger btn-sm">--}}
                                                            {{--                                                                <i class="mdi mdi-delete"></i>--}}
                                                            {{--                                                            </a>--}}
                                                            <form
                                                                action="{{route('categories.destroy', $category->id)}}"
                                                                method="POST">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button class="btn btn-danger btn-sm"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal2"
                                                                        data-bs-placement="top"
                                                                        title="Eliminar"
                                                                        type="submit"
                                                                        onclick="return confirm('¿Estas seguro de eliminar este registro? {{$category->name}}')"
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
                        @if($categoriesDeleted)
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                        <h6 class="text-white text-capitalize ps-3">Lista De Categorias Eliminadas</h6>
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
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($categoriesDeleted as $category)
                                                    <tr>
                                                        <td>{{$loop->index + 1}}</td>
                                                        <td>{{$category->name}}</td>
                                                        <td>
                                                            @if($category->active)
                                                                <label class="badge badge-success">Activo</label>
                                                            @else
                                                                <label class="badge badge-danger">Inactivo</label>
                                                            @endif
                                                        </td>
                                                        <td>
{{--                                                            <a type="button"--}}
{{--                                                               href="{{route('categories.edit', $category->id)}}"--}}
{{--                                                               class="btn btn-primary btn-sm">--}}
{{--                                                                <i class="mdi mdi-pencil"></i>--}}
{{--                                                            </a>--}}
                                                            <form action="{{route('categories.restore', $category->id)}}"
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
