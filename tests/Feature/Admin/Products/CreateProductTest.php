<?php

namespace Tests\Feature\Admin\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function anUnauthenticatedUserCannotAccessToTheCreationRoute()
    {
        $response = $this->get(route('admin.products.create'));
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function anAuthenticatedUserCanAccessToTheCreationRoute()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.products.create'));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function showTheCreationFormFields()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.products.create'));

        $response->assertSee(__('fields.name.label'));
        $response->assertSee(__('fields.code.label'));
        $response->assertSee(__('fields.code.description'));
        $response->assertSee(__('fields.price.label'));
        $response->assertSee(__('fields.description.label'));
        $response->assertSee(route('admin.products.store'));
    }

    /**
     * @test
     */
    public function shouldDisplayTheCorrectView()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.products.create'));

        $response->assertViewIs('admin.products.create');
    }
}
