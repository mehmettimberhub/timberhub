<?php

namespace Timberhub\Supplier\UI\Http;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SuppliersController extends Controller
{
    public function index() : View
    {
        return view('suppliers.index');
    }
}
