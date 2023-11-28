<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'game_id' => $this->faker->uuid,
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
            'attributes' => [
                'strength' => $this->faker->numberBetween(1, 100),
                'dexterity' => $this->faker->numberBetween(1, 100),
                'constitution' => $this->faker->numberBetween(1, 100),
                'intelligence' => $this->faker->numberBetween(1, 100),
                'wisdom' => $this->faker->numberBetween(1, 100),
                'charisma' => $this->faker->numberBetween(1, 100),
            ],
            'type' => $this->faker->randomElement([
                'weapon', 'armor', 'potion', 'ring', 'amulet', 'scroll', 'wand', 'food', 'tool', 'material', 'misc'
            ]),
            'rarity' => $this->faker->randomElement([
                'common', 'uncommon', 'rare', 'epic', 'legendary', 'artifact'
            ]),
            'deprecated' => $this->faker->boolean(10)
        ];
    }
}
