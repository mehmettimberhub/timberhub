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

class CreateProductTest extends TestCase
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
            'thickness' => 120
        ]);
        Livewire::test(ProductForm::class)
            ->set('product', null)
            ->set('length', 220)
            ->set('width', 30)
            ->set('thickness', 120)
            ->set('treatment', Treatment::ANTI_STAIN->value)
            ->set('grade', NordicBlueGrade::A2->value)
            ->set('gradingSystem', GradingSystem::NORDIC_BLUE->value)
            ->set('dyingMethod', DyingMethod::KILN->value)
            ->set('species', ProductSpecies::BIRCH->value)
            ->call('submit');

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
            'thickness' => 120
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
        Livewire::test(ProductForm::class)
            ->set('product', null)
            ->set('length', 220)
            ->set('width', 30)
            ->set('thickness', 120)
            ->set('treatment', Treatment::ANTI_STAIN->value)
            ->set('grade', NordicBlueGrade::A2->value)
            ->set('gradingSystem', GradingSystem::NORDIC_BLUE->value)
            ->set('dyingMethod', DyingMethod::KILN->value)
            ->call('submit');

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
