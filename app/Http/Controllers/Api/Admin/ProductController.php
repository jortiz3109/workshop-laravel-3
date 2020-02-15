<?php

namespace App\Http\Controllers\Api\Admin;

use App\Actions\StoreProductAction;
use App\Actions\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(StoreProductRequest $request, Product $product, StoreProductAction $action)
    {
        return $action->execute($product, $request);
    }

    public function update(UpdateProductRequest $request, Product $product, UpdateProductAction $action)
    {
        return $action->execute($product, $request);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return __('The product was successfully deleted');
    }
}
