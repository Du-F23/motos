<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<div class="row">
@foreach($motos as $moto)
    <div class="card" style="width: 18rem;">
        <img src="{{asset('storage').'/'.$moto->image}}" class="card-img-top"
             alt="{{$moto->name}}">
        <div class="card-body">
            <h5 class="card-title">{{$moto->name}} {{$moto->model}}</h5>
            <p class="card-text">{{$moto->hp}}, {{$moto->color}}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <br>
    <br>
    <br>
@endforeach
</div>
