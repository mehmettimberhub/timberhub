<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Livewire\LivewireDatatable;
use Illuminate\View\View;
use Livewire\Redirector;
use Timberhub\Supplier\Application\Service\SupplierService;
use Timberhub\Supplier\Domain\Actions\DeleteSupplierAction;
use Timberhub\Supplier\Domain\Models\Supplier;

class SupplierList extends LivewireDatatable
{
    public string $sortField = 'id';
    public int $showPerPage = 20;

    protected SupplierService $service;

    public function render() : View
    {
        $this->service = app(SupplierService::class);
        return view('livewire.supplier.supplier-list',
            [
                'records' => $this->service->getAllPaginated(
                    $this->showPerPage,
                    $this->sortField,
                    $this->sortAsc,
                    $this->searchTerm
                )
            ]
        );
    }

    public function search() : void
    {
        $this->resetPage();
        $this->render();
    }

    public function delete(int $id) : Redirector
    {
        $supplier = Supplier::find($id);
        DeleteSupplierAction::execute($supplier);
        session()->flash('danger', 'Supplier is successfully deleted');
        return redirect()->route('suppliers.index');
    }
}
