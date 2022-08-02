@extends('layouts.app')

@section('content')
    <h4>Cupones redimidos:</h4>

    @if(count($cuponsRedimidos) == 0)
        <div class="ms-4">No hay cupones redimidos</div>
    @endif

    @foreach($cuponsRedimidos as $cupon)
        <div class="alert alert-light border mt-3" role="alert">
            <h4 class="alert-heading">{{$cupon->placa}}</h4>
            <hr>
            <p class="mb-0"> <span class="fw-bold">Sitio:</span> {{$cupon->city}}<br>
            <span class="fw-bold">Por:</span> {{$cupon->who}}<br>
            <span class="fw-bold">Día y hora:</span> {{$cupon->updated_at}}<br><br></p>
        </div>
    @endforeach

    <h4 class="mt-3">Cupones sin redimir:</h4>

    @if(count($cuponsRedimibles) == 0)
        <div class="ms-4">No hay cupones redimibles</div>
    @endif
    @foreach($cuponsRedimibles as $cupon)
            <div class="alert alert-light border mt-3" role="alert">
            <h4 class="alert-heading">{{$cupon->placa}}</h4>
            <hr>
            <p class="mb-0"> <span class="fw-bold">Información:</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum doloribus animi cum tenetur sapiente amet quaerat ipsam a ab!<br>
        </div>
    @endforeach
    <a href="{{ route('exportar') }}" class="btn btn-primary">Exportar</a>
@endsection