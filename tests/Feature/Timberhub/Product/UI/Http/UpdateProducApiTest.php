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

class UpdateProducApiTest extends TestCase
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

        $this->put('/api/products/' . $this->product->id, [
            'length' => 220,
            'width' => 30,
            'thickness' => 120,
            'treatment' => Treatment::ANTI_STAIN->value,
            'grade' => NordicBlueGrade::A2->value,
            'gradingSystem' => GradingSystem::NORDIC_BLUE->value,
            'dyingMethod'=> DyingMethod::KILN->value,
            'species'=> ProductSpecies::BIRCH->value,
            'suppliers' => []
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'grading' => Grade::A2,
        ]);
    }

    public function testCannotUpdateProductWithMissingRequiredAttributes() : void
    {
        $this->assertDatabaseMissing('products', [
            'id' => $this->product->id,
            'grading' => Grade::A2
        ]);

        $this->put('/api/products/' . $this->product->id, [
            'length' => 220,
            'width' => 30,
            'thickness' => 120,
            'treatment' => Treatment::ANTI_STAIN->value,
            'grade' => NordicBlueGrade::A2->value,
            'gradingSystem' => GradingSystem::NORDIC_BLUE->value,
            'dyingMethod'=> DyingMethod::KILN->value,
            'suppliers' => []
        ]);

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
