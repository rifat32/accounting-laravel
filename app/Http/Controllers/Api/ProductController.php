<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(Request $request) {
        // form validation is required
       $product =  new Product();
       $product->name = $request->name;
       $product->brand = $request->brand;
       $product->category =  $request->category;
       $product->sku =  $request->sku;
    // $product->quantity =  $request->quantity;
       $product->price =  $request->price;
       $product->wing_id =  (int )$request->wing_id;
       $product->save();
       return response()->json(["product"=>$product],201);
    }

    public function getProducts(Request $request) {
        $products =   Product::with("wing")->paginate(100);
        return response()->json([
             "products" => $products
        ],200);
    }
    public function searchProductByName(Request $request) {
        $product =   Product::with("wing")->where([
            "name" => $request->search
        ])->first();
        if(!$product){
            return response()->json([
                "message" => "No product is found"
           ],404);
        }
        return response()->json([
             "product" => $product
        ],200);
    }
}
