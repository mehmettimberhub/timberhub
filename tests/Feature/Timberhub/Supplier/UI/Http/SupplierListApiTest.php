<?php

namespace Tests\Feature\Timberhub\Supplier\UI\Http;

use App\Http\Livewire\Supplier\SupplierList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Timberhub\Supplier\Domain\Models\Supplier;

class SupplierListApiTest extends TestCase
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
        int $count,
    ) : void
    {
        $response = $this->getJson('/api/suppliers' . ($searchTerm ? '?searchTerm=' . $searchTerm : ''));
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
                'searchTerm' => 'timber',
                'count' => 2,
            ],
            [
                'searchTerm' => 'timber co',
                'count' => 1,
            ],
            [
                'searchTerm' => 'tree',
                'count' => 2,
            ],
            [
                'searchTerm' => 'non existent',
                'count' => 0,
            ],
        ];
    }
}
