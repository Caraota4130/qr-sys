<?php

namespace Database\Factories;

use App\Models\QrCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class QrCodeFactory extends Factory
{
    protected $model = QrCode::class;

    public function definition()
    {
        $types = ['url', 'text', 'email', 'wifi', 'vcard'];
        $type = $this->faker->randomElement($types);
        
        // Configuración base del content
        $content = [
            'type' => $type,
            'data' => $this->getDataByType($type),
            'design' => [
                'color' => $this->faker->hexColor(),
                'size' => $this->faker->numberBetween(150, 300)
            ],
            'created_at' => now()->toISOString()
        ];

        return [
            'name' => $this->faker->words(3, true),
            // 'slug' => $this->faker->slug(),
            'content' => $content,
            'scan_count' => $this->faker->numberBetween(0, 1000),
            'is_active' => $this->faker->boolean(90),
        ];
    }

    private function getDataByType($type)
    {
        return match($type) {
            'url' => $this->faker->url(),
            'email' => $this->faker->email(),
            'wifi' => 'WiFi-' . $this->faker->word(),
            'vcard' => $this->faker->name(),
            default => $this->faker->sentence()
        };
    }
}