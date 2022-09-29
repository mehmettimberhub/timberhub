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

/**
 * Timberhub\Product\Domain\Models\Product
 *
 * @property int $id
 * @property ProductSpecies $species
 * @property GradingSystem $grading_system
 * @property Grade $grading
 * @property DyingMethod $dying_method
 * @property Treatment|null $treatment
 * @property int $thickness
 * @property int $width
 * @property int $length
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Supplier[] $suppliers
 * @property-read int|null $suppliers_count
 * @method static \Database\Factories\Timberhub\Product\Domain\Models\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDyingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGrading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGradingSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSpecies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThickness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTreatment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWidth($value)
 * @mixin \Eloquent
 */
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
