<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ImportProductsAction;
use App\Actions\StoreProductAction;
use App\Actions\UpdateProductAction;
use App\Exceptions\ImportException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportProductRequest;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Imports\ProductsImport;
use App\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::search($request->input('search'))
            ->orderBy('id', $request->get('sort', config('app.sort_direction')))
            ->paginate();

        return response()->view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return response()->view('admin.products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @param Product $product
     * @param StoreProductAction $action
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, Product $product, StoreProductAction $action)
    {
        $product = $action->execute($product, $request);

        return redirect()->route('admin.products.show', $product)->withSuccess(__('The product was successfully created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return response()->view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @param UpdateProductAction $action
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product, UpdateProductAction $action)
    {
        $product = $action->execute($product, $request);

        return redirect()->route('admin.products.show', $product)->withSuccess(__('The product was successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->withSuccess(__('The product was successfully deleted'));
    }

    /**
     * Import the specified resource
     *
     * @param ImportProductRequest $request
     * @param ImportProductsAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ImportProductRequest $request, ImportProductsAction $action)
    {
        try {
            $importedProducts = $action->setImportFile($request->file('import_file'))->execute();
        } catch (ImportException $e) {
            return redirect()->route('admin.products.index')->withErrors($e->errors());
        }

        return redirect()->route('admin.products.index')->withSuccess("{$importedProducts} products were imported!");

    }
}

