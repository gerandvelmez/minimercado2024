<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Producto::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos=$request->validate([
            'nombre'=>['required','string','max:100'],
            'descripcion'=>['nullable','string','max:225'],
            'precio'=>['required','integer','min:1000'],
            'stock'=>['required','integer','min:1'],
        ]);
        $producto=Producto::create($datos);
        return response()->json([
            'mensaje'=>'producto registrado con exito',
            'producto'=>$producto
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return response()->json($producto,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $datos=$request->validate([
            'nombre'=>['required','string','max:100'],
            'descripcion'=>['nullable','string','max:225'],
            'precio'=>['required','integer','min:1000'],
            'stock'=>['required','integer','min:1'],
        ]);
        $producto->update($datos);
        return response()->json([
            'mensaje'=>'producto actualizado con exito',
            'producto'=>$producto
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json([
            'mensaje'=>'producto eliminado con exito',
            ], 204);
    }
}
