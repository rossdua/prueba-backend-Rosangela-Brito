<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPrice;

class ProductPriceController extends Controller
{
    public function index($id)
    {
        // GET /products/{id}/prices: Obtener lista de precios de un producto[cite: 2]
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($product->prices()->with('currency')->get(), 200);
    }

    public function store(Request $request, $id)
    {
        // POST /products/{id}/prices: Crear un nuevo precio para un producto[cite: 2]
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validated = $request->validate([
            'currency_id' => 'required|exists:currencies,id',
            'price' => 'required|numeric|min:0',
        ]);

        // Evitar duplicados para la misma divisa en el mismo producto
        $productPrice = ProductPrice::updateOrCreate(
            ['product_id' => $product->id, 'currency_id' => $validated['currency_id']],
            ['price' => $validated['price']]
        );

        return response()->json([
            'message' => 'Precio registrado exitosamente',
            'data' => $productPrice->load('currency')
        ], 201);
    }
}
