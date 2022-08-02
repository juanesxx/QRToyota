@extends('layouts.app')

@section('content')
    <h4>Cupones redimidos:</h4>

    @if(count($cuponsRedimidos) == 0)
        No hay cupones redimidos<br><br>
    @endif


    @foreach($cuponsRedimidos as $cupon)
        <div class="alert alert-light border mt-3" role="alert">
            <h4 class="alert-heading">{{$cupon->placa}}</h4>
            <p class="mb-0"> <span class="fw-bold">Sitio:</span> {{$cupon->city}}<br>
            <span class="fw-bold">Por:</span> {{$cupon->who}}<br>
            <span class="fw-bold">Día y hora:</span> {{$cupon->updated_at}}<br><br></p>
        </div>
    @endforeach
    <a href="{{ route('exportar') }}" class="btn btn-primary">Exportar</a>

@endsection