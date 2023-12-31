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
                                        <h6 class="text-white text-capitalize ps-3">Lista De Motos</h6>
                                        <div class="float-end">
                                            {{-- Button del modal --}}
                                            <a href="{{route('motos.create')}}" class="btn btn-primary"
                                               title="Agregar una nueva Moto">
                                                <i class="mdi mdi-plus-circle-outline"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($motos as $moto)
                                            <div class="card" style="width: 18rem; margin: 10px">
                                                <img src="{{asset('storage').'/'.$moto->image}}" class="card-img-top"
                                                     alt="{{$moto->name}}">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$moto->name}} {{$moto->model}}</h5>
                                                    <p class="card-text">C.C. {{$moto->hp}},
                                                    <p class="card-text">Colores: {{$moto->color}}</p>
                                                    <p class="card-text">Año {{$moto->year}}</p>
                                                </div>
                                                <div class="card-footer">
                                                    <a type="button"
                                                       href="{{route('motos.edit', Vinkla\Hashids\Facades\Hashids::encode($moto->id))}}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <a type="button"
                                                       href="{{route('motos.show', Vinkla\Hashids\Facades\Hashids::encode($moto->id))}}"
                                                       class="btn btn-success btn-sm text-white">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1"
                                                            data-bs-placement="top"
                                                            title="Eliminar"
                                                            type="button"
                                                            onclick="deleteCategory({{$moto->id}})"
                                                    >
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--Motos borradas--}}
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
                                                            <td>
                                                                <div class="col-auto">
                                                                    <img src="{{asset('storage/'.$moto->image)}}"
                                                                         alt="{{$moto->name}}&nbsp;{{$moto->model}}">
                                                                    &nbsp;&nbsp;{{$moto->name}}&nbsp;{{$moto->model}}
                                                                </div>
                                                            </td>
                                                            <td>{{$moto->year}}</td>
                                                            <td>{{$moto->hp}}</td>
                                                            <td>{{$moto->color}}</td>
                                                            <td>{{$moto->category->name}}</td>
                                                            <td>
                                                                <button
                                                                    class="btn btn-rounded-success btn-sm align-content-md-center align-items-center align-self-center"
                                                                    title="Restore"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal3"
                                                                    data-bs-placement="top"
                                                                    onclick="restoreRegistro({{$moto->id}})"
                                                                >
                                                                    Reactivar
                                                                    &nbsp;&nbsp;
                                                                    <i class="mdi mdi-backup-restore"></i>
                                                                </button>

                                                                <button
                                                                    class="btn btn-danger btn-sm align-content-md-center align-items-center align-self-center"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal2"
                                                                    data-bs-placement="top"
                                                                    title="Eliminar Permanentemente"
                                                                    type="button"
                                                                    onclick="deleteMoto({{$moto->id}})"
                                                                >
                                                                    Eliminar
                                                                    &nbsp;&nbsp;
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
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

                    {{--                    modal para eliminar--}}
                    <div class="modal fade" id="exampleModal1" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Moto Temporalmente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <form action="" id="deleteForm" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p id="banner">¿Estas seguro de eliminar este registro?</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Cancelar
                                                        </button>
                                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal2" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Moto Permanentemente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <form action="" id="permanentDelete" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p id="bannerDelete">¿Estas seguro de eliminar este registro?</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Cancelar
                                                        </button>
                                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal3" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Restaurar Moto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <form action="" id="restaurarForm" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <p id="bannerRestore">¿Estas seguro de restaurar este registro?</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Cancelar
                                                        </button>
                                                        <button class="btn btn-rounded-check" type="submit">Restaurar
                                                        </button>
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
            <script type="application/javascript">
                // hace una peticion ajax para obtener la informacion de la moto
                function deleteCategory(id) {
                    let form = document.getElementById('deleteForm')
                    form.action = '/motos/' + id
                    $.ajax({
                        url: '/motos/' + id + '/json',
                        type: 'GET',
                        success: function (response) {
                            //console.log(response.name)
                            $('#banner').html('¿Estas seguro de eliminar este registro? ' + response.name + ' ' + response.model);
                        }
                    })
                }

                function deleteMoto(id) {
                    let form = document.getElementById('permanentDelete')
                    form.action = '/motos/' + id + '/force'
                    $.ajax({
                        url: '/motos/' + id + '/json',
                        type: 'GET',
                        success: function (response) {
                            //console.log(response.name)
                            $('#bannerDelete').html('¿Estas seguro de eliminar este registro? ' + response.name + ' ' + response.model);
                        }
                    })
                }

                function restoreRegistro(id) {
                    let form = document.getElementById('restaurarForm')
                    form.action = '/motos/' + id + '/restaurar'
                    $.ajax({
                        url: '/motos/' + id,
                        type: 'GET',
                        success: function (response) {
                            //console.log(response.name)
                            $('#bannerRestore').html('¿Estas seguro de restaurar este registro? ' + response.name + ' ' + response.model);
                        }
                    })
                }
            </script>
        </div>
    </div>
@endsection
