@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')
<div class="container">
    <h1 class="mb-4">Productos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">

        {{-- Card para crear nuevo producto --}}
        <div class="col">
            <a href="{{ route('productos.create') }}" class="text-decoration-none text-center text-muted">
                <div class="card h-100 border-dashed" style="border: 2px dashed #ccc;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h1>+</h1>
                        <p>Agregar nuevo producto</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Cards de productos --}}
        @foreach($productos as $producto)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">

                    {{-- Contenido superior: nombre y descripción --}}
                    <div>
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text descripcion">{{ $producto->descripcion }}</p>
                    </div>

                    {{-- Contenido medio: precio, stock y categoría --}}
                    <div>
                        <p class="card-text"><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                        <p class="card-text"><strong>Stock:</strong> {{ $producto->stock }}</p>
                        <p class="card-text text-muted"><small>Categoría: {{ $producto->categoria->nombre ?? 'Sin categoría' }}</small></p>
                    </div>

                    {{-- Botones de acción --}}
                    <div class="mt-3 d-flex justify-content-between">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?');">
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
