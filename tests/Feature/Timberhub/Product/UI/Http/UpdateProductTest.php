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

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;
    private ?Product $product = null;

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

    public function testUpdateProduct() : void
    {
        $this->assertDatabaseMissing('products', [
            'id' => $this->product->id,
            'grading' => Grade::A2
        ]);

        Livewire::test(ProductForm::class)
            ->set('product', $this->product)
            ->set('species', ProductSpecies::BIRCH->value)
            ->set('dyingMethod', DyingMethod::AIR_DRIED->value)
            ->set('gradingSystem', GradingSystem::NORDIC_BLUE->value)
            ->set('grade', NordicBlueGrade::A2->value)
            ->set('treatment', Treatment::ANTI_STAIN->value)
            ->set('length', 1200)
            ->set('thickness', 120)
            ->set('width', 30)
            ->call('submit');

        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'grading' => Grade::A2
        ]);
    }

    public function testCannotUpdateProductWithMissingRequiredAttributes() : void
    {
        $this->assertDatabaseMissing('products', [
            'id' => $this->product->id,
            'grading' => Grade::A2
        ]);

        Livewire::test(ProductForm::class)
            ->set('product', $this->product)
            ->set('species', ProductSpecies::BIRCH->value)
            ->set('dyingMethod', DyingMethod::AIR_DRIED->value)
            ->set('gradingSystem', GradingSystem::NORDIC_BLUE->value)
            ->set('grade', NordicBlueGrade::A2->value)
            ->set('treatment', Treatment::ANTI_STAIN->value)
            ->set('thickness', 120)
            ->set('width', 30)
            ->call('submit');

        $this->assertDatabaseMissing('products', [
            'id' => $this->product->id,
            'grading' => Grade::A2
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'grading' => Grade::A1
        ]);
    }
}
