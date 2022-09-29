<?php

namespace Timberhub\Product\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Timberhub\Product\Domain\Enums\DyingMethod;
use Timberhub\Product\Domain\Enums\Grade;
use Timberhub\Product\Domain\Enums\GradingSystem;
use Timberhub\Product\Domain\Enums\ProductSpecies;
use Timberhub\Product\Domain\Enums\Treatment;
use Timberhub\Supplier\Domain\Models\Supplier;

final class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'products';
    protected $casts = [
        'species' => ProductSpecies::class,
        'grading_system' => GradingSystem::class,
        'grading' => Grade::class,
        'dying_method' => DyingMethod::class,
        'treatment' => Treatment::class
    ];

    public function suppliers() : BelongsToMany
    {
        return $this->belongsToMany(Supplier::class);
    }
}
