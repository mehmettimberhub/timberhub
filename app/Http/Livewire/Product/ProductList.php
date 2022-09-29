<?php

namespace App\Http\Livewire\Product;

use App\Http\Livewire\LivewireDatatable;
use Livewire\Redirector;
use Timberhub\Product\Application\Service\ProductService;
use Timberhub\Product\Domain\Actions\DeleteProductAction;
use Timberhub\Product\Domain\Models\Product;

class ProductList extends LivewireDatatable
{
    public string $sortField = 'id';
    public ?int $supplier_id = null;

    protected ProductService $service;

    public function render()
    {
        $this->service = app(ProductService::class);
        return view('livewire.product.product-list',
            [
                'records' => $this->service->getAllPaginated(
                    $this->showPerPage,
                    $this->sortField,
                    $this->sortAsc,
                    $this->searchTerm,
                    $this->supplier_id > 0 ? $this->supplier_id : null
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
        $product = Product::find($id);
        DeleteProductAction::execute($product);
        session()->flash('danger', 'Product is successfully deleted');
        return redirect()->route('products.index');
    }
}
