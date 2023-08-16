<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Enums\Products\DyingMethod;
use App\Enums\Products\Grade;
use App\Enums\Products\GradingSystem;
use App\Enums\Products\ProductSpecies;
use App\Enums\Products\Treatment;

final class ProductVariation extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'product_variations';

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
