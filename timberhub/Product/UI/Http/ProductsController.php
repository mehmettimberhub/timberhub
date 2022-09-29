<?php

namespace Timberhub\Product\UI\Http;

use Illuminate\View\View;

class ProductsController
{
    public function index() : View
    {
        return view('products.index');
    }
}
