<?php

namespace Tests\Feature\Admin\Products\Concerns;

use Illuminate\Support\Str;

trait ProductTestHasProviders
{
    /**
     * An array with basic product data
     *
     * @var array
     */
    protected $productBaseData = [
        'code' => 'PRD001',
        'name' => 'Amazing product',
        'price' => 5000,
        'description' => 'This is an amazing product'
    ];

    /**
     * Data provider for store validations test
     *
     * @return array
     */
    public function storeTestDataProvider(): array
    {
        return [
            'code field is null' => [
                array_replace_recursive($this->productBaseData, ['code' => null]),
                'code'
            ],
            'code field is too short' => [
                array_replace_recursive($this->productBaseData, ['code' => 'PRD']),
                'code'
            ],
            'code field is too long' => [
                array_replace_recursive($this->productBaseData, ['code' => 'PRD1234']),
                'code'
            ],
            'code field is not a string' => [
                array_replace_recursive($this->productBaseData, ['code' => true]),
                'code'
            ],
            'name field is null' => [
                array_replace_recursive($this->productBaseData, ['name' => null]),
                'name'
            ],
            'name field is too short' => [
                array_replace_recursive($this->productBaseData, ['name' => 'a']),
                'name'
            ],
            'name field is too long' => [
                array_replace_recursive($this->productBaseData, ['name' => Str::random(81)]),
                'name'
            ]
        ];
    }
}
