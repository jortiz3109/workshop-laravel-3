<?php

namespace Tests\Feature\Admin\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;
    use Concerns\ProductTestHasProviders;

    /**
     * @test
     */
    public function anUnauthenticatedUserCannotStoreAProduct()
    {
        $response = $this->post(route('admin.products.store'), []);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function anAuthenticatedUserCanStoreAProduct()
    {
        $user = factory(User::class)->create();

        $data = [
            'code' => 'PRD001',
            'name' => 'Amazing product',
            'price' => 5000,
            'description' => 'This is an amazing product'
        ];

        $response = $this->actingAs($user)->post(route('admin.products.store'), $data);

        $response->assertRedirect();
    }

    /**
     * @test
     */
    public function aProductIsStoredInDatabase()
    {
        $user = factory(User::class)->create();

        $data = [
            'code' => 'PRD001',
            'name' => 'Amazing product',
            'price' => 5000,
            'description' => 'This is an amazing product'
        ];

        $this->actingAs($user)->post(route('admin.products.store'), $data);

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
            ->post(route('admin.products.store'), $productData);

        $response->assertSessionHasErrors($field);
    }
}
