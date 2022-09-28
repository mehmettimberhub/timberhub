<?php

namespace App\Http\Livewire\Supplier;

use Illuminate\View\View;
use Livewire\Component;
use Timberhub\Product\Domain\DTOs\SupplierData;
use Timberhub\Supplier\Domain\Actions\SaveSupplierAction;
use Timberhub\Supplier\Domain\Models\Supplier;

class SupplierForm extends Component
{
    public null|string $name = '';
    public ?Supplier $supplier = null;

    public function render() : View
    {
        return view('livewire.supplier.supplier-form');
    }

    public function mount(?Supplier $supplier) : void
    {
        $this->supplier = $supplier;
        if($this->supplier instanceof Supplier){
            $this->name = $supplier->name;
        }
    }

    protected function rules() :array
    {
        return [
            'name' => 'required|unique:suppliers,name,'. $this->supplier->id,
            'supplier' => 'nullable'
        ];
    }

    public function submit()
    {
        $this->validate($this->rules());
        $data = new SupplierData($this->name);
        $this->supplier = SaveSupplierAction::execute($data, $this->supplier);

        session()->flash('success', 'Supplier is successfully saved');
        return redirect()->route('suppliers.edit', ['supplier' => $this->supplier->id]);
    }
}
