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
       $product->pName = $request->pName;
       $product->pBrand = $request->pBrand;
       $product->pCategory =  $request->pCategory;
       $product->pSku =  $request->pSku;
       $product->pQuantity =  $request->pQuantity;
       $product->pPrice =  $request->pPrice;
       $product->save();
       return response()->json(["product"=>$product],201);
    }

    public function getProducts(Request $request) {
        $products =   Product::paginate(100);
        return response()->json([
             "products" => $products
        ],200);
    }
    public function searchProductByName(Request $request) {
        $product =   Product::where([
            "pName" => $request->search
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
