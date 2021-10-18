<?php

namespace App\Http\Services;

use App\Models\Product;

trait ProductServices
{
    public function createProductService($request)
    {
        $product =   Product::create($request->all());
        return response()->json(["product" => $product], 201);
    }

    public function getProductsService($request)
    {
        $products =   Product::with("wing")->paginate(100);
        return response()->json([
            "products" => $products
        ], 200);
    }
    public function searchProductByNameService($request)
    {
        $product =   Product::with("wing")->where([
            "name" => $request->search
        ])->first();
        if (!$product) {
            return response()->json([
                "message" => "No product is found"
            ], 404);
        }
        return response()->json([
            "product" => $product
        ], 200);
    }
}
