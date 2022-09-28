<?php

namespace Database\Factories\Timberhub\Supplier\Domain\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use Timberhub\Supplier\Domain\Models\Supplier;

final class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    #[ArrayShape(['name' => "string"])]
    public function definition() : array
    {
        return [
            'name' => $this->faker->company
        ];
    }
}
