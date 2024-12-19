<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'username' => 'expired_tst_1',
            'expired_at' => new \DateTimeImmutable('yesterday'),
        ]);
    }
}
