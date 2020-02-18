<?php

namespace App\Imports;

use App\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements toModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @inheritDoc
     */
    public function model(array $row)
    {
        $product = new Product;
        $product->name = $row['name'];
        $product->code = $row['code'];
        $product->price = $row['price'];
        $product->description = $row['description'];

        return $product;
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            '*.code' => ['bail','required','string','size:6', Rule::unique('products')],
            '*.name' => ['bail','required', 'string', 'min:2', 'max:80', Rule::unique('products')],
            '*.price' => ['bail','required', 'numeric'],
        ];
    }
}
