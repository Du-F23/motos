@extends('layouts.app')

@section('title', 'Editar Categorias')

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
                                        <h6 class="text-white text-capitalize ps-3">Categoria {{$category->name}}</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container">
                                            <form action="{{ route('categories.update', $category->id) }}"
                                                  method="POST">
                                                <div class="row">
                                                    {{-- generar el token para el envio de dato csrf --}}
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}

                                                    <label class="col" for="">Nombre de la
                                                        Categoria:</label>
                                                    <input id="name" class="col form-control"
                                                           type="text" name="name" value="{{$category->name}}" required>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Guardar
                                                        </button>
                                                        <a href="{{ route('categories.index') }}"
                                                           class="btn btn-danger">Regresar</a>
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
