<?php

namespace Tests\Feature\Admin\Products;

use App\Product;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexProductTests extends TestCase
{
    use RefreshDatabase;

    /**
     * Validates that authorized user can view the index of products
     *
     * @test
     * @return void
     */
    public function authorizedUserCanViewTheProductsIndex()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->get(route('admin.products.index'))
            ->assertOk();
    }

    /**
     * Validates that unauthenticated user cannot access
     * to the index of products
     * and is redirected to the login page
     *
     * @test
     * @return void
     */
    public function unauthorizedUsersCannotAccessTheProductsIndex()
    {
        $this->get(route('admin.products.index'))
            ->assertRedirect(route('login'));
    }

    /**
     * Validates that the index of products has products
     *
     * @test
     * @return void
     */
    public function theIndexOfFranchiseHasFranchise()
    {
        factory(Product::class, 5)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.products.index'));

        $response->assertViewHas('products');
    }

    /**
     * Validates that the index of products has products paginated
     *
     * @test
     * @return void
     */
    public function theIndexOfFranchiseHasFranchisePaginated()
    {
        factory(Product::class, 5)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.products.index'));

        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $response->original->gatherData()['products']
        );
    }

    /**
     * Validates when no products where found a message should be displayed to the user
     *
     * @test
     * @return void
     */
    public function displayMessageToTheUserWhenNoProductsWhereFound()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.products.index'));

        $response->assertSee(__('No products were found'));
    }

    /**
     * Can search products by name
     *
     * @test
     * @return void
     */
    public function canSearchProductsByName()
    {
        $user = factory(User::class)->create();
        $productA = factory(Product::class)->create(['name' => 'Test product']);
        $productB = factory(Product::class)->create(['name' => 'Other product']);

        $response = $this->actingAs($user)->get(route('admin.products.index', ['search' => 'test']));

        $viewProducts = $response->original->gatherData()['products'];

        $this->assertTrue($viewProducts->contains($productA));
        $this->assertFalse($viewProducts->contains($productB));
    }

    /**
     * Can search products by code
     *
     * @test
     * @return void
     */
    public function canSearchProductsByCode()
    {
        $user = factory(User::class)->create();
        $productA = factory(Product::class)->create(['code' => 'PRD1234']);
        $productB = factory(Product::class)->create(['code' => 'CRQ567']);

        $response = $this->actingAs($user)->get(route('admin.products.index', ['search' => 'PRD1234']));

        $viewProducts = $response->original->gatherData()['products'];

        $this->assertTrue($viewProducts->contains($productA));
        $this->assertFalse($viewProducts->contains($productB));
    }
}
