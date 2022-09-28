<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Timberhub\Product\Domain\Models\Product;
use Timberhub\Supplier\Domain\Models\Supplier;

final class DatabaseSeeder extends Seeder
{
    public function run() : void
    {
        Supplier::factory(10)->create();
        Product::factory(50)->create();

        $products = Product::all();
        $suppliers = Supplier::all();

        $suppliers->each(static function (Supplier $supplier) use ($products){
            $supplier->products()->attach(
                $products->random(random_int(5,10))->pluck('id')->toArray()
            );
        });
    }
}
