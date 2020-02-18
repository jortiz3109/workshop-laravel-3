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
            return new Product([
                'name' => $row['name'],
                'code' => $row['code'],
                'price' => $row['price'],
                'description' => $row['description'],
            ]);
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
