<?php

namespace Database\Seeders;

use App\Models\UserPosition;
use Illuminate\Database\Seeder;

class UserPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UserPosition::query()->create([
            'title' => 'Position 1',
        ]);

        UserPosition::query()->create([
            'title' => 'Position 2',
        ]);

        UserPosition::query()->create([
            'title' => 'Position 3',
        ]);
    }
}
