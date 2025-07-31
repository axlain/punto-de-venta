@extends('layouts.app')

@section('title', 'Listado de Apartados')

@section('content')
<div class="container">
    <h1 class="mb-4">Apartados</h1>
    <form method="GET" action="{{ route('apartados.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por cliente..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">

        {{-- Card para crear nuevo apartado --}}
        <div class="col">
            <a href="{{ route('apartados.create') }}" class="text-decoration-none text-center text-muted">
                <div class="card h-100 border-dashed" style="border: 2px dashed #ccc;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h1>+</h1>
                        <p>Agregar nuevo apartado</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Cards de apartados --}}
        @foreach($apartados as $apartado)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">

                    {{-- Parte superior: Cliente y fecha --}}
                    <div>
                        <h5 class="card-title">{{ $apartado->cliente }}</h5>
                        <p class="card-text text-muted"><small>{{ $apartado->fecha }}</small></p>
                    </div>

                    {{-- Parte media: Producto, montos --}}
                    <div>
                        <p class="card-text"><strong>Producto:</strong>
                            @if($apartado->producto)
                                {{ $apartado->producto->nombre }}
                            @else
                                {{ $apartado->producto_manual }}
                            @endif
                        </p>
                        <p class="card-text"><strong>Total:</strong> ${{ number_format($apartado->total, 2) }}</p>
                        <p class="card-text"><strong>Monto entregado:</strong> ${{ number_format($apartado->monto, 2) }}</p>
                        <p class="card-text"><strong>Restante:</strong> ${{ number_format($apartado->restante, 2) }}</p>
                        <p class="card-text"><strong>Pagado:</strong> {{ $apartado->pagado ? 'Sí' : 'No' }}</p>
                    </div>

                    {{-- Acciones --}}
                    <div class="mt-3 d-flex justify-content-between">
                        <a href="{{ route('apartados.show', $apartado) }}" class="btn btn-sm btn-outline-info">Ver</a>
                        <a href="{{ route('apartados.edit', $apartado) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                        <form action="{{ route('apartados.destroy', $apartado) }}" method="POST" onsubmit="return confirm('¿Eliminar este apartado?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
