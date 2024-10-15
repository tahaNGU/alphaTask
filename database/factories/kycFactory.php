<?php

namespace Database\Factories;
use Illuminate\Http\UploadedFile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\kyc>
 */
class kycFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'national_code'=>rand(1000000000,9000000000),
            'birthday'=>'1389/01/02'
        ];
    }
}
