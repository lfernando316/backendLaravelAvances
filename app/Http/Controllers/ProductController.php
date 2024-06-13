<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Product;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nombre' => 'sometimes|required|string|max:255',
                'precio' => 'sometimes|required|numeric',
            ]);

            $product = Product::findOrFail($id);
            $product->update($request->all());
            return response()->json($product, 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'El producto no fue encontrado.'], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $mensaje = ['mensaje' => 'El producto fue eliminado'];
        return response()->json($mensaje, 204);
    }
}
