<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // GET /products: Obtener lista de productos
        return response()->json(Product::with(['baseCurrency', 'prices.currency'])->get(), 200);
    }

    public function store(Request $request)
    {
        // POST /products: Crear un nuevo producto[cite: 2]
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'currency_id' => 'required|exists:currencies,id',
            'tax_cost' => 'required|numeric|min:0',
            'manufacturing_cost' => 'required|numeric|min:0',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'data' => $product->load('baseCurrency')
        ], 201);
    }

    public function show($id)
    {
        // GET /products/{id}: Obtener un producto por ID[cite: 2]
        $product = Product::with(['baseCurrency', 'prices.currency'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($product, 200);
    }

    public function update(Request $request, $id)
    {
        // PUT /products/{id}: Actualizar un producto[cite: 2]
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'currency_id' => 'sometimes|exists:currencies,id',
            'tax_cost' => 'sometimes|numeric|min:0',
            'manufacturing_cost' => 'sometimes|numeric|min:0',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'data' => $product->load('baseCurrency')
        ], 200);
    }

    public function destroy($id)
    {
        // DELETE /products/{id}: Eliminar un producto[cite: 2]
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Producto eliminado exitosamente'], 200);
    }
}
