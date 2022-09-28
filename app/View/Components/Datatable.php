<?php

namespace App\View\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class Datatable extends Component
{

    public LengthAwarePaginator $records;

    public function __construct(LengthAwarePaginator $records)
    {
        $this->records = $records;
    }

    public function render() : View
    {
        return view('components.datatable',
            [
                'records' => $this->records,
            ]);
    }
}
