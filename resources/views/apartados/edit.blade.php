@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Apartado</h1>

    <form action="{{ route('apartados.update', $apartado) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Cliente</label>
            <input type="text" name="cliente" class="form-control" value="{{ $apartado->cliente }}" required>
        </div>

        <div class="mb-3">
            <label>Fecha</label>
            <input type="datetime-local" name="fecha" class="form-control"
                   value="{{ \Carbon\Carbon::parse($apartado->fecha)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label>Seleccionar Producto</label>
            <select name="producto_id" class="form-select" onchange="toggleManualFields(this.value)">
                <option value="">-- Ninguno (Manual) --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}"
                        {{ $apartado->producto_id == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }} - ${{ $producto->precio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="manual-fields">
            <label>Producto (Manual)</label>
            <input type="text" name="producto_manual" class="form-control"
                   value="{{ $apartado->producto_manual }}">
            <input type="number" name="precio_manual" class="form-control mt-2"
                   step="0.01" value="{{ $apartado->precio_manual }}">
        </div>

        <div class="mb-3">
            <label>Monto entregado por el cliente</label>
            <input type="number" name="monto" step="0.01" class="form-control" value="{{ $apartado->monto }}" required>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="pagado" id="pagado"
                   {{ $apartado->pagado ? 'checked' : '' }}>
            <label class="form-check-label" for="pagado">¿Pagado?</label>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>

<script>
    function toggleManualFields(productId) {
        document.getElementById('manual-fields').style.display = productId ? 'none' : 'block';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const select = document.querySelector('[name="producto_id"]');
        toggleManualFields(select.value);
    });
</script>
@endsection
