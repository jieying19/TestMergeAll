<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amountOwed = 500;
        $amountPayed = $this->faker->randomFloat(2, 0, $amountOwed);

        return [
            'userName' => $this->faker->randomElement(['Wan', 'Junta', 'Abby', 'Jie']),
            'amountOwed' => $amountOwed,
            'amountPayed' => $amountPayed,
            'paymentMethod' => $this->faker->randomElement(['Card','E-Wallet']),
            'lastPayment' => $this->faker->dateTime(),
            'cardNumber' => $this->faker->numberBetween(null, 99),
            'bankName' => $this->faker->randomElement(['Maybank','Bank Islam','RHB']),
            'cardCVV' => $this->faker->numberBetween(100, 999),
            'cardExpDate' => $this->faker->dateTime(),
            'cardHolderName' => $this->faker->randomElement(['Wan', 'Junta', 'Abby', 'Jie']),
            'paymentStatus' => null
        ];
    }
}
