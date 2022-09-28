<?php

namespace Tests\Feature\Timberhub\Supplier\UI\Http;

use App\Http\Livewire\Supplier\SupplierList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Timberhub\Supplier\Domain\Models\Supplier;

class SupplierListTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Supplier::factory()->count(4)->sequence(
            [
                'name' => 'Timber Co.'
            ],
            [
                'name' => 'Happy tree'
            ],
            [
                'name' => 'Apple tree'
            ],
            [
                'name' => 'Timberoo'
            ],
        )->create();
    }

    /**
     * @dataProvider getSupplierFilterData
     */
    public function testCanListAndFilterSuppliers(
        string $searchTerm,
        array $results,
    ) : void
    {
        $allSuppliers = Supplier::all()->pluck('name')
            ->map(fn($supplier) => '<td>' . $supplier . '</td>')
            ->toArray();
        $notListed = array_diff($allSuppliers, $results);
        Livewire::test(SupplierList::class)
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
                    '<td>Timber Co.</td>',
                    '<td>Happy tree</td>',
                    '<td>Apple tree</td>',
                    '<td>Timberoo</td>',
                ],
            ],
            [
                'searchTerm' => 'timber',
                'results' => [
                    '<td>Timber Co.</td>',
                    '<td>Timberoo</td>'
                ],
            ],
            [
                'searchTerm' => 'timber co',
                'results' => [
                    '<td>Timber Co.</td>',
                ],
            ],
            [
                'searchTerm' => 'tree',
                'results' => [
                    '<td>Happy tree</td>',
                    '<td>Apple tree</td>'
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
