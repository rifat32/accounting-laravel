<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Services\ProductServices;

class ProductController extends Controller
{
    use ProductServices;
    public function createProduct(ProductRequest $request)
    {

        return $this->createProductService($request);
    }

    public function getProducts(Request $request)
    {

        return $this->getProductsService($request);
    }
    public function searchProductByName(Request $request)
    {
        return $this->searchProductByNameService($request);
    }
}
