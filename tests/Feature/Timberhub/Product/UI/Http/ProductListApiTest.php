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
use Timberhub\Product\Domain\Enums\TegernseerGrade;
use Timberhub\Product\Domain\Enums\Treatment;
use Timberhub\Product\Domain\Models\Product;
use Timberhub\Supplier\Domain\Models\Supplier;

class ProductListApiTest extends TestCase
{
    use RefreshDatabase;

    private ?Supplier $supplier1 = null;
    private ?Supplier $supplier2 = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->supplier1 = Supplier::factory()->create(['id' => 1]);
        $this->supplier2 = Supplier::factory()->create(['id' => 2]);
        Product::factory()->count(4)->sequence(
            [
                'species' => ProductSpecies::BIRCH,
                'grading_system' => GradingSystem::NORDIC_BLUE,
                'grading' => NordicBlueGrade::A1,
                'dying_method' => DyingMethod::AIR_DRIED,
                'treatment' => Treatment::ANTI_STAIN,
                'length' => 1200,
                'thickness' => 120,
                'width' => 30,
            ],
            [
                'species' => ProductSpecies::APPLE,
                'grading_system' => GradingSystem::NORDIC_BLUE,
                'grading' => NordicBlueGrade::A2,
                'dying_method' => DyingMethod::KILN,
                'treatment' => Treatment::ANTI_STAIN,
                'length' => 1200,
                'thickness' => 120,
                'width' => 30,
            ],
            [
                'species' => ProductSpecies::FIR,
                'grading_system' => GradingSystem::TEGERNSEER,
                'grading' => TegernseerGrade::I,
                'dying_method' => DyingMethod::FRESH,
                'treatment' => Treatment::HEAT,
                'length' => 1200,
                'thickness' => 120,
                'width' => 30,
            ],
            [
                'species' => ProductSpecies::PINE,
                'grading_system' => GradingSystem::TEGERNSEER,
                'grading' => TegernseerGrade::II,
                'dying_method' => DyingMethod::AIR_DRIED,
                'treatment' => Treatment::ANTI_STAIN,
                'length' => 1200,
                'thickness' => 120,
                'width' => 30,
            ]
        )->create();
        $productOne = Product::whereSpecies(ProductSpecies::BIRCH->value)->first();
        $productTwo = Product::whereSpecies(ProductSpecies::APPLE->value)->first();
        $productThree = Product::whereSpecies(ProductSpecies::FIR->value)->first();

        $productOne->suppliers()->attach([$this->supplier1->id, $this->supplier2->id]);
        $productTwo->suppliers()->attach([$this->supplier1->id]);
        $productThree->suppliers()->attach([$this->supplier2->id]);
    }

    /**
     * @dataProvider getSupplierFilterData
     */
    public function testCanListAndFilterProducts(
        string $searchTerm,
        ?int $supplierId,
        int $count,
    ) : void
    {
        $response = $this
            ->getJson('/api/products' . '?searchTerm='. $searchTerm . ($supplierId ? '&supplier_id=' . $supplierId : ''));
        $response->assertOk();

        $this->ensureResponseStructure($response);

        $this->assertCount(
            $count,
            $response->json()['data']
        );
    }

    private function getSupplierFilterData() : array
    {
        return [
            [
                'searchTerm' => '',
                'supplierId' => null,
                'count' => 4,
            ],
            [
                'searchTerm' => 'fir',
                'supplierId' => null,
                'count' => 1,
            ],
            [
                'searchTerm' => 'air',
                'supplierId' => null,
                'count' => 2,
            ],
            [
                'searchTerm' => 'fr',
                'supplierId' => null,
                'count' => 1,
            ],
            [
                'searchTerm' => 'non existent',
                'supplierId' => null,
                'count' => 0,
            ],
            [
                'searchTerm' => '',
                'supplierId' => 1,
                'count' => 2,
            ],
            [
                'searchTerm' => '',
                'supplierId' => 2,
                'count' => 2,
            ],
        ];
    }
}
