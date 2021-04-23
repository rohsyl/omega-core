<?php
namespace rohsyl\OmegaCore\Models\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use rohsyl\OmegaCore\Models\Member;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => $this->faker->password,
            'email' => $this->faker->unique()->safeEmail,
            'is_enabled' => true,
            'validated_at' => $this->faker->dateTime,
        ];
    }
}