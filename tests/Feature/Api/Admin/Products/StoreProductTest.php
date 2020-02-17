<?php

namespace Tests\Feature\Api\Admin\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Admin\Products\Concerns\ProductTestHasProviders;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;
    use ProductTestHasProviders;

    /**
     * @test
     */
    public function aProductIsStoredInDatabase()
    {
        $data = [
            'code' => 'PRD001',
            'name' => 'Amazing product',
            'price' => 5000,
            'description' => 'This is an amazing product'
        ];

        $this->postJson(route('api.admin.products.store'), $data);

        $this->assertDatabaseHas('products', $data);
    }

    /**
     * Test that a product cannot be stored
     * due to some data was not passed the validation rules
     *
     * @param array $productData Array of values to post
     * @param string $field field that has failed
     *
     * @return       void
     * @test
     * @dataProvider storeTestDataProvider
     */
    public function aProductCannotBeStoredDueToValidationErrors(
        array $productData,
        string $field
    ) {
        $user = factory(User::class)->create();

        $response =  $this
            ->actingAs($user)
            ->postJson(route('api.admin.products.store'), $productData);

        $response->assertJsonValidationErrors($field);
    }
}
