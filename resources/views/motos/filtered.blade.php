<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="row">
    <input hidden="hidden" name="id" id="id" value="{{$id}}">
    <div class="col-lg-6 d-flex grid-margin stretch-card">
        <div class="card sale-diffrence-border">
            <div class="card-body">
                <h2 class="mb-2 font-weight-bold">C.C.</h2>
                <select class="form-select"
                        aria-label="Seleccionar C.C de la Moto" name="hp" id="hp">
                    <option selected>Seleccione una opcion</option>
                    @foreach($hp as $hp)
                        <option
                            value="{{$hp->hp}}">{{$hp->hp}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 d-flex grid-margin stretch-card">
        <div class="card sale-diffrence-border">
            <div class="card-body">
                <h2 class="mb-2 font-weight-bold">Año</h2>
                <select class="form-select"
                        aria-label="Seleccionar año de la Moto" name="year" id="year">
                    <option selected>Seleccione una opcion</option>
                    @foreach($years as $year)
                        <option
                            value="{{$year->year}}">{{$year->year}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    {{--    <div class="col-lg-6 d-flex grid-margin stretch-card" id="showMotosByCategory">--}}
    @foreach($motos as $moto)
        <div class="card" style="width: 18rem; margin: 10px" id="showMotosByCategory">
            <img src="{{asset('storage').'/'.$moto->image}}" class="card-img-top"
                 alt="{{$moto->name}}">
            <div class="card-body">
                <h5 class="card-title">{{$moto->name}} {{$moto->model}}</h5>
                <p class="card-text">C.C. {{$moto->hp}},
                <p class="card-text">Colores: {{$moto->color}}</p>
                <p class="card-text">Año {{$moto->year}}</p>
                <a href="{{ route('motos.show', Vinkla\Hashids\Facades\Hashids::encode($moto->id)) }}"
                   class="btn btn-primary">Ver Más</a>
            </div>
        </div>
        <br>
        <br>
        <br>
    @endforeach
    {{--    </div>--}}
    <script type="application/javascript">
        $(document).ready(function () {
            var id = $('#id').val();
            var year = null;
            var hp = null;
            $('#year').on('change', function () {
                if (this.value !== "Selecciona una opcion") {
                    year = this.value;
                    $.ajax({
                        url: "/motosByCategory/" + id + "/" + this.value,
                        type: "get",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            //si la respuesta del servidor es exitosa se ejecuta esta funcion y se muestra el resultado
                            $('#showMotosByCategory').html(data);
                        }
                    });
                }
            });
            $('#hp').on('change', function () {
                if (this.value !== "Selecciona una opcion") {
                    hp = this.value
                    $.ajax({
                        url: "/motosByCategory/" + id + "/" + this.value,
                        type: "get",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            //si la respuesta del servidor es exitosa se ejecuta esta funcion y se muestra el resultado
                            $('#showMotosByCategory').html(data);
                        }
                    });

                }
            });
        });
    </script>

</div>
