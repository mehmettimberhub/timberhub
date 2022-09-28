<?php

namespace Tests\Feature\Timberhub\Supplier\UI\Http;

use App\Http\Livewire\Supplier\SupplierForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Timberhub\Supplier\Domain\Models\Supplier;

class CreateSupplierTest extends TestCase
{
    use RefreshDatabase;

    protected const SUPPLIER_ONE_NAME = 'SupplierOne';

    public function testSuccessfullyCreateSupplier() : void
    {
        $this->assertDatabaseMissing('suppliers', [
            'name' => self::SUPPLIER_ONE_NAME
        ]);

        Livewire::test(SupplierForm::class)
            ->set('name', self::SUPPLIER_ONE_NAME)
            ->call('submit');

        $this->assertDatabaseHas('suppliers', [
            'name' => self::SUPPLIER_ONE_NAME
        ]);
    }

    public function testCannotCreateIfNameExistsOnDatabase() : void
    {
        Supplier::factory()->create([
            'name' => self::SUPPLIER_ONE_NAME
        ]);

        $this->assertDatabaseHas('suppliers', [
            'name' => self::SUPPLIER_ONE_NAME
        ]);

        Livewire::test(SupplierForm::class)
            ->set('name', self::SUPPLIER_ONE_NAME)
            ->call('submit')
            ->assertHasErrors(['name' => 'unique']);

        self::assertEquals(1, Supplier::whereName(self::SUPPLIER_ONE_NAME)->count());
    }
}
