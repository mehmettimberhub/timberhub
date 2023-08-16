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
use App\Enums\Products\TegernseerGrade;
use App\Enums\Products\Treatment;
use App\Models\Products\Product;

class ProductListApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Product::factory()->count(4)->sequence(
            [
                'species' => ProductSpecies::BIRCH,
                'grading_system' => GradingSystem::NORDIC_BLUE,
                'grading' => NordicBlueGrade::A1,
                'dying_method' => DyingMethod::AIR_DRIED,
                'treatment' => Treatment::ANTI_STAIN,
            ],
            [
                'species' => ProductSpecies::APPLE,
                'grading_system' => GradingSystem::NORDIC_BLUE,
                'grading' => NordicBlueGrade::A2,
                'dying_method' => DyingMethod::KILN,
                'treatment' => Treatment::ANTI_STAIN,
            ],
            [
                'species' => ProductSpecies::FIR,
                'grading_system' => GradingSystem::TEGERNSEER,
                'grading' => TegernseerGrade::I,
                'dying_method' => DyingMethod::FRESH,
                'treatment' => Treatment::HEAT,
            ],
            [
                'species' => ProductSpecies::PINE,
                'grading_system' => GradingSystem::TEGERNSEER,
                'grading' => TegernseerGrade::II,
                'dying_method' => DyingMethod::AIR_DRIED,
                'treatment' => Treatment::ANTI_STAIN,
            ]
        )->create();
    }

    /**
     * @dataProvider getSupplierFilterData
     */
    public function testCanListAndFilterProducts(
        string $searchTerm,
        int $count,
    ) : void
    {
        $response = $this
            ->getJson('/api/products' . '?searchTerm='. $searchTerm);
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
                'count' => 4,
            ],
            [
                'searchTerm' => 'fir',
                'count' => 1,
            ],
            [
                'searchTerm' => 'air',
                'count' => 2,
            ],
            [
                'searchTerm' => 'fr',
                'count' => 1,
            ],
            [
                'searchTerm' => 'non existent',
                'count' => 0,
            ],
        ];
    }
}
