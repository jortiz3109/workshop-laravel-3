<?php


namespace App\Actions;

use Highlight\Mode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreProductAction extends Action
{
    public function storeModel(Model $product, Request $request): Model
    {
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();

        return $product;
    }
}
