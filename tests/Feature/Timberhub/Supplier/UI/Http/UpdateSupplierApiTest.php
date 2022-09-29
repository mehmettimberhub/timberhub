<?php

namespace Tests\Feature\Timberhub\Supplier\UI\Http;

use App\Http\Livewire\Supplier\SupplierForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Timberhub\Supplier\Domain\Models\Supplier;

class UpdateSupplierApiTest extends TestCase
{
    use RefreshDatabase;

    protected const SUPPLIER_ONE_NAME = 'SupplierOne';
    protected const SUPPLIER_ONE_NAME_UPDATED = 'SupplierOneUpdated';

    public function setUp(): void
    {
        parent::setUp();
        Supplier::factory()->create(['name' => self::SUPPLIER_ONE_NAME]);
    }

    public function testUpdateSupplier() : void
    {
        $this->assertDatabaseHas('suppliers', [
            'name' => self::SUPPLIER_ONE_NAME
        ]);

        $supplier = Supplier::whereName(self::SUPPLIER_ONE_NAME)->first();

        $this->put('/api/suppliers/' . $supplier->id, [
            'name' => self::SUPPLIER_ONE_NAME_UPDATED
        ]);

        $this->assertDatabaseHas('suppliers', [
            'name' => self::SUPPLIER_ONE_NAME_UPDATED
        ]);

        $this->assertDatabaseMissing('suppliers', [
            'name' => self::SUPPLIER_ONE_NAME
        ]);
    }
}
