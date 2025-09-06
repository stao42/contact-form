<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genders = [1, 2, 3]; // 1:男性 2:女性 3:その他
        $categoryIds = [1, 2, 3, 4, 5]; // categoriesテーブルのID（5つのカテゴリ）

        return [
            'category_id' => $this->faker->randomElement($categoryIds),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement($genders),
            'email' => $this->faker->email(),
            'tel' => $this->faker->numerify('080########'),
            'address' => $this->faker->address(),
            'building' => $this->faker->optional(0.3)->buildingNumber(),
            'detail' => $this->faker->text(100),
        ];
    }
}
