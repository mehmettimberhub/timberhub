<?php

namespace Timberhub\Supplier\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Timberhub\Product\Domain\Models\Product;

final class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'suppliers';

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
