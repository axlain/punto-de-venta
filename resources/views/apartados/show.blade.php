@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalle del Apartado</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Cliente:</strong> {{ $apartado->cliente }}</li>
        <li class="list-group-item"><strong>Fecha:</strong> {{ $apartado->fecha }}</li>
        <li class="list-group-item">
            <strong>Producto:</strong>
            @if($apartado->producto)
                {{ $apartado->producto->nombre }}
            @else
                {{ $apartado->producto_manual }}
            @endif
        </li>
        <li class="list-group-item"><strong>Total:</strong> ${{ $apartado->total }}</li>
        <li class="list-group-item"><strong>Monto entregado:</strong> ${{ $apartado->monto }}</li>
        <li class="list-group-item"><strong>Restante:</strong> ${{ $apartado->restante }}</li>
        <li class="list-group-item"><strong>Pagado:</strong> {{ $apartado->pagado ? 'Sí' : 'No' }}</li>
    </ul>

    <a href="{{ route('apartados.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection
