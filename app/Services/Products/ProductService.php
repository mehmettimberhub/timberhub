<?php

namespace App\Services\Products;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Products\Product;

class ProductService
{
    public function getAllPaginated(int $perPage, string $sortField, bool $sortAsc, ?string $search = null, ?int $supplier_id = null): LengthAwarePaginator
    {
        $query = Product::query();
        if ($search !== '') {
            $query = $query->where(fn($q) => $q->where('species', 'like', '%' . $search . '%')
                ->orWhere('grading_system', 'like', '%' . $search . '%')
                ->orWhere('grading', '=', $search)
                ->orWhere('dying_method', 'like', '%' . $search . '%')
                ->orWhere('treatment', 'like', '%' . $search . '%')
            );
        }
        return $query->orderBy($sortField, $sortAsc ? 'asc' : 'desc')->paginate($perPage);
    }
}
