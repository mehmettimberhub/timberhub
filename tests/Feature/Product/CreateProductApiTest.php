<?php

namespace Tests\Feature\Product;

use App\Http\Livewire\Product\ProductForm;
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

class CreateProductApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateProduct(): void
    {
        $this->assertDatabaseMissing('products', [
            'treatment' => Treatment::ANTI_STAIN->value,
            'grading' => Grade::A2->value,
            'grading_system' => GradingSystem::NORDIC_BLUE->value,
            'dying_method' => DyingMethod::KILN->value,
            'species' => ProductSpecies::BIRCH->value,
        ]);
        $this->assertDatabaseMissing('product_variations', [
            'length' => 220,
            'width' => 30,
            'thickness' => 120,
        ]);
        $this->post('/api/products', [
            'length' => 220,
            'width' => 30,
            'thickness' => 120,
            'treatment' => Treatment::ANTI_STAIN->value,
            'grade' => NordicBlueGrade::A2->value,
            'gradingSystem' => GradingSystem::NORDIC_BLUE->value,
            'dyingMethod'=> DyingMethod::KILN->value,
            'species'=> ProductSpecies::BIRCH->value
        ]);

        $this->assertDatabaseHas('products', [
            'treatment' => Treatment::ANTI_STAIN->value,
            'grading' => Grade::A2->value,
            'grading_system' => GradingSystem::NORDIC_BLUE->value,
            'dying_method' => DyingMethod::KILN->value,
            'species' => ProductSpecies::BIRCH->value,
        ]);
        $this->assertDatabaseHas('product_variations', [
            'length' => 220,
            'width' => 30,
            'thickness' => 120,
        ]);
    }

    public function testCannotCreateProductWithMissingRequiredProperties(): void
    {
        $this->assertDatabaseMissing('products', [
            'treatment' => Treatment::ANTI_STAIN->value,
            'grading' => Grade::A2->value,
            'grading_system' => GradingSystem::NORDIC_BLUE->value,
            'dying_method' => DyingMethod::KILN->value,
        ]);
        $this->assertDatabaseMissing('product_variations', [
            'length' => 220,
            'width' => 30,
            'thickness' => 120
        ]);
        $this->post(route('products.create', [
            'length' => 220,
            'width' => 30,
            'thickness' => 120,
            'treatment' => Treatment::ANTI_STAIN->value,
            'grade' => NordicBlueGrade::A2->value,
            'gradingSystem' => GradingSystem::NORDIC_BLUE->value,
            'dyingMethod'=> DyingMethod::KILN->value,
        ]));

        $this->assertDatabaseMissing('products', [
            'treatment' => Treatment::ANTI_STAIN->value,
            'grading' => Grade::A2->value,
            'grading_system' => GradingSystem::NORDIC_BLUE->value,
            'dying_method' => DyingMethod::KILN->value,
        ]);
        $this->assertDatabaseMissing('product_variations', [
            'length' => 220,
            'width' => 30,
            'thickness' => 120
        ]);
    }
}
