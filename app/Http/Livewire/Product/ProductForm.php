<?php

namespace App\Http\Livewire\Product;

use App\Actions\Products\DeleteProductVariationAction;
use App\Http\Livewire\LivewireDatatable;
use App\Services\Products\ProductService;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use App\Actions\Products\SaveProductAction;
use App\DTO\Products\ProductData;
use App\Enums\Products\DyingMethod;
use App\Enums\Products\Grade;
use App\Enums\Products\GradingSystem;
use App\Enums\Products\ProductSpecies;
use App\Enums\Products\Treatment;
use App\Models\Products\Product;

class ProductForm extends LivewireDatatable
{
    public ?Product $product = null;
    public ?string $species = null;
    public ?string $gradingSystem = null;
    public ?string $grade = null;
    public ?string $dyingMethod = null;
    public ?string $treatment = null;
    public ?int $thickness = null;
    public ?int $width = null;
    public ?int $length = null;
    protected ProductService $service;
    public string $sortField = 'thickness';

    public function render() : View
    {
        $this->service = app(ProductService::class);
        return view('livewire.product.product-form', [
            'records' => $this->service->getVariationsOfProductPaginated(
                $this->product,
                $this->showPerPage,
                $this->sortField,
                $this->sortAsc,
                $this->searchTerm
            )
        ]);
    }

    public function mount(?Product $product) : void
    {
        if($this->product instanceof Product){
            $this->product = $product;
            $this->species = $this->product->species->value;
            $this->gradingSystem = $this->product->grading_system->value;
            $this->grade = $this->product->grading->value;
            $this->dyingMethod = $this->product->dying_method->value;
            $this->treatment = $this->product->treatment?->value;
            $this->thickness = $this->product->thickness;
            $this->width = $this->product->width;
            $this->length = $this->product->length;
        }
    }

    protected function rules() : array
    {
        return [
            'product' => 'nullable',
            'species' => 'required|in:' . implode(',', ProductSpecies::caseValues()),
            'gradingSystem' => 'required|in:' . implode(',', GradingSystem::caseValues()),
            'grade' => 'required|in:' . implode(',', Grade::caseValues()),
            'dyingMethod' => 'required|in:' . implode(',', DyingMethod::caseValues()),
            'treatment' => 'nullable|in:' . implode(',', Treatment::caseValues()) . ', 0',
            'thickness' => 'required|integer',
            'width' => 'required|integer',
            'length' => 'required|integer'
        ];
    }

    public function deleteVariation(int $productVariationId) : void
    {
        DeleteProductVariationAction::execute($productVariationId);
        session()->flash('danger', 'Product variation is successfully deleted');
        $this->render();
    }

    public function submit() : Redirector
    {
        $this->validate($this->rules());
        $data = new ProductData(
            species: ProductSpecies::tryFrom($this->species),
            gradingSystem: GradingSystem::tryFrom($this->gradingSystem),
            grade: Grade::tryFrom($this->grade),
            dyingMethod: DyingMethod::tryFrom($this->dyingMethod),
            treatment: $this->treatment !== 0 ?Treatment::tryFrom($this->treatment) : null,
            thickness: $this->thickness,
            width: $this->width,
            length: $this->length
        );
        $product = SaveProductAction::execute($data, $this->product);
        session()->flash('success', 'Product saved successfully');
        return redirect()->route('products.edit', ['product' => $product]);
    }
}
