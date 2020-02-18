<?php

namespace Tests\Feature\Admin\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Validates that authorized user can import products
     *
     * @test
     * @return void
     */
    public function authorizedUserCanImportProducts()
    {
        $user = factory(User::class)->create();

        $file = UploadedFile::fake()->createWithContent(
            'SuccessImportFile.xlsx',
            file_get_contents(
                base_path('tests/Stubs/SuccessImportFile.xlsx')
            )
        );

        $response = $this
            ->actingAs($user)
            ->post(route('admin.products.import'), ['import_file' => $file]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    /**
     * Validates that unauthenticated user cannot import products
     * and is redirected to the login page
     *
     * @test
     * @return void
     */
    public function unAuthorizedUsersCannotImportProducts()
    {
        $this->post(route('admin.products.import'))
            ->assertRedirect(route('login'));
    }

    /**
     * Validates that products can be imported
     *
     * @test
     * @return void
     */
    public function productsCanBeImported()
    {
        $user = factory(User::class)->create();

        $file = UploadedFile::fake()->createWithContent(
            'SuccessImportFile.xlsx',
            file_get_contents(
                base_path('tests/Stubs/SuccessImportFile.xlsx')
            )
        );

        $this
            ->actingAs($user)
            ->post(route('admin.products.import'), ['import_file' => $file]);

        $this->assertDatabaseHas('products', [
            'code' => 'PRD001',
            'name' => 'Cellphone',
            'price' => '150',
            'description' => 'This is an amazing cellphone'
        ]);
    }

    /**
     * Validates that products can be imported
     *
     * @test
     * @return void
     */
    public function productsCannotBeImportedDueValidationErrors()
    {
        $user = factory(User::class)->create();

        $file = UploadedFile::fake()->createWithContent(
            'ValidationErrorsImportFile.xlsx',
            file_get_contents(
                base_path('tests/Stubs/ValidationErrorsImportFile.xlsx')
            )
        );

        $response = $this
            ->actingAs($user)
            ->post(route('admin.products.import'), ['import_file' => $file]);

        $response->assertSessionHasErrors();
    }

    /**
     * Validates that products can be imported
     *
     * @test
     * @return void
     */
    public function productsCannotBeImportedDueDuplicatedProduct()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create([
            'code' => 'PRD001',
            'name' => 'Cellphone',
            'price' => '150',
            'description' => 'This is an amazing cellphone'
        ]);

        $file = UploadedFile::fake()->createWithContent(
            'SuccessImportFile.xlsx',
            file_get_contents(
                base_path('tests/Stubs/SuccessImportFile.xlsx')
            )
        );

        $response = $this
            ->actingAs($user)
            ->post(route('admin.products.import'), ['import_file' => $file]);

        $response->assertSessionHasErrors();
    }
}
