<?php

namespace Database\Factories\Products;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use App\Models\Products\Product;


final class ProductFactory extends Factory
{
    protected $model = Product::class;

    #[ArrayShape(['species' => "mixed", 'grading_system' => "mixed", 'grading' => "mixed", 'dying_method' => "mixed", 'treatment' => "mixed", 'thickness' => "mixed", 'width' => "mixed", 'length' => "mixed"])]
    public function definition() : array
    {
        $productAttributes = $this->uniqueProductAttributes();
        return [
            'species' => $productAttributes['species'],
            'grading_system' => $productAttributes['grading_system'],
            'grading' => $productAttributes['grading'],
            'dying_method' => $productAttributes['dying_method'],
            'treatment' => $productAttributes['treatment'],
        ];
    }

    #[ArrayShape(['species' => "mixed", 'grading_system' => "mixed", 'grading' => "mixed", 'dying_method' => "mixed", 'treatment' => "mixed", 'thickness' => "mixed", 'width' => "mixed", 'length' => "mixed"])]
    private function uniqueProductAttributes(): array
    {
        $speciesArray = ['pine', 'spruce', 'fir', 'birch', 'apple'];
        $gradingSystems = ['nordic_blue', 'tegernseer'];
        $gradingNordicArray = ['A1', 'A2', 'A3', 'A4', 'B1'];
        $gradingTagernseerArray = ['O', 'I', 'II', 'III', 'IV', 'V'];
        $dyingMethodArray = ['fresh', 'kiln_dried', 'air_dried'];
        $treatmentArray = ['heat', 'anti_stain'];

        $species = $speciesArray[random_int(0, 4)];
        $gradingSystem = $gradingSystems[random_int(0, 1)];
        $grading = $gradingSystem === 'nordic_blue' ? $gradingNordicArray[random_int(0, 4)] : $gradingTagernseerArray[random_int(0, 5)];
        $dying = $dyingMethodArray[random_int(0, 2)];
        $treatment = $treatmentArray[random_int(0, 1)];

        $existingProduct = Product::whereSpecies($species)
            ->whereGradingSystem($gradingSystem)
            ->whereGrading($grading)
            ->whereDyingMethod($dying)
            ->whereTreatment($treatment)
            ->first();

        if (!$existingProduct instanceof Product) {
            return [
                'species' => $species,
                'grading_system' => $gradingSystem,
                'grading' => $grading,
                'dying_method' => $dying,
                'treatment' => $treatment,
            ];
        }

        return $this->uniqueProductAttributes();
    }
}
