<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
    $this->call([
        JapanSeeder::class,
    ]);

      if (app()->isLocal()) {
         User::updateOrCreate(
            ['email' => 'dev@example.com'],
            ['name' => 'Dev User', 'password' => Hash::make('Passw0rd!')]
         );
      }
    }
}
