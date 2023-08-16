<?php

namespace Tests\Feature\Product;

use App\Http\Livewire\Product\ProductList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Enums\Products\DyingMethod;
use App\Enums\Products\Grade;
use App\Enums\Products\GradingSystem;
use App\Enums\Products\NordicBlueGrade;
use App\Enums\Products\ProductSpecies;
use App\Enums\Products\Treatment;
use App\Models\Products\Product;

class ProductDeleteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $product = Product::factory()->create([
            'species' => ProductSpecies::BIRCH,
            'grading_system' => GradingSystem::NORDIC_BLUE,
            'grading' => NordicBlueGrade::A1,
            'dying_method' => DyingMethod::AIR_DRIED,
            'treatment' => Treatment::ANTI_STAIN,
        ]);
        $this->product = $product;
    }

    public function testDeleteProduct() : void
    {
        $product = Product::all()->first();
        $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);

        Livewire::test(ProductList::class)
            ->call('delete', $product->id);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}
