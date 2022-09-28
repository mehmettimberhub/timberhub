<?php

namespace App\Http\Livewire\Supplier;

use App\Http\Livewire\LivewireDatatable;
use Illuminate\View\View;
use Timberhub\Supplier\Application\Service\SupplierService;

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
        $this->render();
    }
}
