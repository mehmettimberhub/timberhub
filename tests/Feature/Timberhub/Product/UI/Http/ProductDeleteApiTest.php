<?php

namespace Tests\Feature\Timberhub\Product\UI\Http;

use App\Http\Livewire\Product\ProductList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Timberhub\Product\Domain\Enums\DyingMethod;
use Timberhub\Product\Domain\Enums\GradingSystem;
use Timberhub\Product\Domain\Enums\NordicBlueGrade;
use Timberhub\Product\Domain\Enums\ProductSpecies;
use Timberhub\Product\Domain\Enums\Treatment;
use Timberhub\Product\Domain\Models\Product;

class ProductDeleteApiTest extends TestCase
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
            'length' => 1200,
            'thickness' => 120,
            'width' => 30,
        ]);
        $this->product = $product;
    }

    public function testDeleteProduct() : void
    {
        $product = Product::all()->first();
        $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);

        $this->delete('/api/products/' . $product->id);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}
