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

class ProductListTest extends TestCase
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
        array $results,
    ) : void
    {
        $allProducts = Product::all()->pluck('species')
            ->map(fn($product) => '<td>' . $product->value . '</td>')
            ->toArray();
        $notListed = array_diff($allProducts, $results);
        Livewire::test(ProductList::class)
            ->set('searchTerm', $searchTerm)
            ->assertSeeHtmlInOrder($results)
            ->assertDontSeeHtml($notListed);
    }

    private function getSupplierFilterData() : array
    {
        return [
            [
                'searchTerm' => '',
                'results' => [
                    '<td>Birch</td>',
                    '<td>Apple</td>',
                    '<td>Fir</td>',
                    '<td>Pine</td>',
                ],
            ],
            [
                'searchTerm' => 'fir',
                'results' => [
                    '<td>Fir</td>',
                ],
            ],
            [
                'searchTerm' => 'air',
                'results' => [
                    '<td>Birch</td>',
                    '<td>Pine</td>',
                ],
            ],
            [
                'searchTerm' => 'fr',
                'results' => [
                    '<td>Fir</td>',
                ],
            ],
            [
                'searchTerm' => 'non existent',
                'results' => [

                ],
            ],
        ];
    }
}
