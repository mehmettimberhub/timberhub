<?php

namespace Timberhub\Product\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Timberhub\Supplier\Domain\Models\Supplier;

final class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'products';

    public function suppliers() : BelongsToMany
    {
        return $this->belongsToMany(Supplier::class);
    }
}
