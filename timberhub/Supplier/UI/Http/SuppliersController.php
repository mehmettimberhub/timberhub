<?php

namespace Timberhub\Supplier\UI\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Timberhub\Supplier\Domain\Models\Supplier;

class SuppliersController extends Controller
{
    public function index() : View
    {
        return view('suppliers.index');
    }

    public function create() : View
    {
        return view('suppliers.create');
    }

    public function edit(Supplier $supplier) : View
    {
        return view('suppliers.edit', ['supplier' => $supplier]);
    }
}
