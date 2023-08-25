@extends('layouts.app')
@section('title', 'Servicios')

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
                                        <h6 class="text-white text-capitalize ps-3">Servicios</h6>
                                        <div class="float-end">
                                            {{-- Button del modal --}}
                                            <a href="{{route('services.create')}}" class="btn btn-primary"
                                               title="Agregar una nueva Moto">
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
                                                    <th>Fecha de Servicio</th>
                                                    <th>Moto</th>
                                                    <th>Piezas Cambiadas</th>
                                                    <th>Dueño</th>
                                                    <th>Costos de Servicio</th>
                                                    <th>Gastos Totales</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($services  as $service)
                                                    <tr>
                                                        <td>{{$loop->index + 1}}</td>
                                                        <td>{{\Carbon\Carbon::parse($service->date_service)->format('D, d/m/y')}}</td>
                                                        <td>
                                                            <img src="{{asset('storage/'.$service->motos->image)}}"
                                                                 alt="{{$service->motos->name}} {{$service->motos->model}}">
                                                            {{$service->motos->name}} &nbsp; {{$service->motos->model}}
                                                        </td>
                                                        <td>
                                                            @foreach($service->products as $piece)
                                                                {{$piece->marca}} {{$piece->piece}}
                                                                @if (!$loop->last)
                                                                    ,
                                                                @endif
                                                                <br>
                                                            @endforeach
                                                        </td>
                                                        <td>{{$service->user}}</td>
                                                        <td>$ {{$service->costo_servicio}}</td>
                                                        <td>$ {{$service->total}}</td>
                                                        <td>
                                                            <a type="button"
                                                               href="{{route('services.edit', Vinkla\Hashids\Facades\Hashids::encode($service->id))}}"
                                                               class="btn btn-primary btn-sm">
                                                                <i class="mdi mdi-pencil" z></i>
                                                            </a>
                                                            <a type="button"
                                                               href="{{route('services.show', Vinkla\Hashids\Facades\Hashids::encode($service->id))}}"
                                                               class="btn btn-success btn-sm text-white">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal1"
                                                                    data-bs-placement="top"
                                                                    title="Eliminar"
                                                                    type="button"
                                                                    onclick="deleteService({{$service->id}})"
                                                            >
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
                        <div class="modal fade" id="exampleModal1" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Servicio Temporalmente</h5>
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
                    </div>
                </div>
            </div>
        </div>
        <script type="application/javascript">
            // hace una peticion ajax para obtener la informacion de la moto
            function deleteService(id) {
                let form = document.getElementById('deleteForm')
                form.action = '/services/' + id + '/delete'
                $.ajax({
                    url: '/servicios/' + id,
                    type: 'GET',
                    success: function (response) {
                        console.log(response)
                        $('#banner').html('¿Estas seguro de eliminar este registro? ' + response.date_service + ' a nombre de ' + response.user);
                    }
                })
            }
        </script>
@endsection
