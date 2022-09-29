<?php

namespace Tests\Feature\Timberhub\Product\UI\Http;

use App\Http\Livewire\Product\ProductForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Timberhub\Product\Domain\Enums\DyingMethod;
use Timberhub\Product\Domain\Enums\Grade;
use Timberhub\Product\Domain\Enums\GradingSystem;
use Timberhub\Product\Domain\Enums\NordicBlueGrade;
use Timberhub\Product\Domain\Enums\ProductSpecies;
use Timberhub\Product\Domain\Enums\Treatment;
use Timberhub\Product\Domain\Models\Product;
use Timberhub\Supplier\Domain\Models\Supplier;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    protected const SUPPLIER_ONE_NAME = 'supplier1';
    protected const SUPPLIER_TWO_NAME = 'supplier2';
    protected const SUPPLIER_THREE_NAME = 'supplier3';

    protected function setUp(): void
    {
        parent::setUp();
        Supplier::factory()->count(3)
            ->sequence(
                [
                    'name' => self::SUPPLIER_ONE_NAME
                ],
                [
                    'name' => self::SUPPLIER_TWO_NAME
                ],
                [
                    'name' => self::SUPPLIER_THREE_NAME
                ]
            )->create();
    }

    public function testCreateProduct(): void
    {
        $this->assertDatabaseMissing('products', [
            'treatment' => Treatment::ANTI_STAIN->value,
            'grading' => Grade::A2->value,
            'grading_system' => GradingSystem::NORDIC_BLUE->value,
            'dying_method' => DyingMethod::KILN->value,
            'species' => ProductSpecies::BIRCH->value,
            'length' => 220,
            'width' => 30,
            'thickness' => 120
        ]);
        Livewire::test(ProductForm::class)
            ->set('suppliers', Supplier::all()->pluck('id')->toArray())
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
            'length' => 220,
            'width' => 30,
            'thickness' => 120
        ]);

        $product = Product::whereDyingMethod(DyingMethod::KILN->value)->first();
        self::assertEquals(3, $product->suppliers->count());
    }

    public function testCannotCreateProductWithMissingRequiredProperties(): void
    {
        $this->assertDatabaseMissing('products', [
            'treatment' => Treatment::ANTI_STAIN->value,
            'grading' => Grade::A2->value,
            'grading_system' => GradingSystem::NORDIC_BLUE->value,
            'dying_method' => DyingMethod::KILN->value,
            'length' => 220,
            'width' => 30,
            'thickness' => 120
        ]);
        Livewire::test(ProductForm::class)
            ->set('suppliers', Supplier::all()->pluck('id')->toArray())
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
            'length' => 220,
            'width' => 30,
            'thickness' => 120
        ]);
    }
}
