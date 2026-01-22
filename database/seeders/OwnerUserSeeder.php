<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class OwnerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user pemilik untuk testing
        User::firstOrCreate(
            ['email' => 'pemilik@projectindonesia.test'],
            [
                'name' => 'Pemilik P Project Indonesia',
                'password' => bcrypt('password123'),
                'no_hp' => '0812345678',
                'alamat' => 'Jakarta, Indonesia',
                'role' => 'pemilik',
                'avatar_url' => null,
            ]
        );

        echo "✓ Owner user created successfully!\n";
        echo "Email: pemilik@projectindonesia.test\n";
        echo "Password: password123\n";
    }
}
