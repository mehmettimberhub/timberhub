<?php

namespace Tests\Feature\Timberhub\Supplier\UI\Http;

use App\Http\Livewire\Supplier\SupplierList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Timberhub\Supplier\Domain\Models\Supplier;

class DeleteSupplierTest extends TestCase
{
    use RefreshDatabase;

    public function testCanDeleteExistingSupplier() : void
    {
        $supplier = Supplier::factory()->create();
        $this->assertDatabaseHas('suppliers', [
            'name' => $supplier->name,
        ]);

        Livewire::test(SupplierList::class)
            ->call('delete', $supplier->id);

        $this->assertDatabaseMissing('suppliers', [
            'name' => $supplier->name,
        ]);
    }
}
