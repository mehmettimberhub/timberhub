<?php

namespace Tests\Feature\Timberhub\Supplier\UI\Http;

use App\Http\Livewire\Supplier\SupplierList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Timberhub\Supplier\Domain\Models\Supplier;

class DeleteSupplierApiTest extends TestCase
{
    use RefreshDatabase;

    public function testCanDeleteExistingSupplier() : void
    {
        $supplier = Supplier::factory()->create();
        $this->assertDatabaseHas('suppliers', [
            'name' => $supplier->name,
        ]);

        $this->delete('/api/suppliers/' . $supplier->id);

        $this->assertDatabaseMissing('suppliers', [
            'name' => $supplier->name,
        ]);
    }
}
