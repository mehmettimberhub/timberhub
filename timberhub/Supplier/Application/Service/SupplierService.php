<?php

namespace Timberhub\Supplier\Application\Service;

use Illuminate\Pagination\LengthAwarePaginator;
use Timberhub\Supplier\Domain\Models\Supplier;

class SupplierService
{
    public function getAllPaginated(int $perPage, string $sortField, bool $sortAsc, string $search): LengthAwarePaginator
    {
        $query = Supplier::query();
        if ($search !== '') {
            $query = $query->where('name', 'like', '%' . $search . '%');
        }
        return $query->orderBy($sortField, $sortAsc ? 'asc' : 'desc')->paginate($perPage);
    }
}
