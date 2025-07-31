<?php

namespace App\Http\Controllers;

use App\Models\Apartado;
use App\Models\Producto;
use Illuminate\Http\Request;

class ApartadoController extends Controller
{
    // Mostrar todos los apartados

    public function index(Request $request)
    {
        $query = Apartado::with('producto')->latest();

        // Si hay búsqueda por cliente
        if ($request->has('search') && !empty($request->search)) {
            $query->where('cliente', 'like', '%' . $request->search . '%');
        }

        $apartados = $query->get();

        return view('apartados.index', compact('apartados'));
    }


    // Mostrar el formulario para crear un nuevo apartado
    public function create()
    {
        $productos = Producto::all();
        return view('apartados.create', compact('productos'));
    }

    // Guardar un nuevo apartado
    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'producto_id' => 'nullable|exists:productos,id',
            'producto_manual' => 'nullable|string|max:255',
            'precio_manual' => 'nullable|numeric|min:0',
            'pagado' => 'nullable|boolean',
        ]);

        // Determinar total basado en producto seleccionado o ingreso manual
        if ($request->filled('producto_id')) {
            $producto = Producto::findOrFail($request->producto_id);
            $total = $producto->precio;
            $productoManual = null;
            $precioManual = null;
        } else {
            $producto = null;
            $total = $request->precio_manual;
            $productoManual = $request->producto_manual;
            $precioManual = $request->precio_manual;
        }

        $restante = $total - $request->monto;

        Apartado::create([
            'cliente' => $request->cliente,
            'fecha' => $request->fecha,
            'total' => $total,
            'monto' => $request->monto,
            'restante' => $restante,
            'pagado' => $request->has('pagado'),
            'producto_id' => $producto?->id,
            'producto_manual' => $productoManual,
            'precio_manual' => $precioManual,
        ]);

        return redirect()->route('apartados.index')->with('success', 'Apartado registrado correctamente.');
    }

    // Mostrar un apartado específico
    public function show(Apartado $apartado)
    {
        $apartado->load('producto');
        return view('apartados.show', compact('apartado'));
    }

    // Mostrar el formulario para editar un apartado
    public function edit(Apartado $apartado)
    {
        $productos = Producto::all();
        return view('apartados.edit', compact('apartado', 'productos'));
    }

    // Actualizar un apartado
    public function update(Request $request, Apartado $apartado)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'producto_id' => 'nullable|exists:productos,id',
            'producto_manual' => 'nullable|string|max:255',
            'precio_manual' => 'nullable|numeric|min:0',
            'pagado' => 'nullable|boolean',
        ]);

        if ($request->filled('producto_id')) {
            $producto = Producto::findOrFail($request->producto_id);
            $total = $producto->precio;
            $productoManual = null;
            $precioManual = null;
        } else {
            $producto = null;
            $total = $request->precio_manual;
            $productoManual = $request->producto_manual;
            $precioManual = $request->precio_manual;
        }

        $restante = $total - $request->monto;

        $apartado->update([
            'cliente' => $request->cliente,
            'fecha' => $request->fecha,
            'total' => $total,
            'monto' => $request->monto,
            'restante' => $restante,
            'pagado' => $request->has('pagado'),
            'producto_id' => $producto?->id,
            'producto_manual' => $productoManual,
            'precio_manual' => $precioManual,
        ]);

        return redirect()->route('apartados.index')->with('success', 'Apartado actualizado correctamente.');
    }

    // Eliminar un apartado
    public function destroy(Apartado $apartado)
    {
        $apartado->delete();
        return redirect()->route('apartados.index')->with('success', 'Apartado eliminado correctamente.');
    }
}
