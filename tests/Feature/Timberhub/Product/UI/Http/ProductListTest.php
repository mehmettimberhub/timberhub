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
