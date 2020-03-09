<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Менеджер'],
            ['name' => 'Разработчик'],
            ['name' => 'Верстальщик']
        ];

        if (!\App\Models\Role::get()->count()) {
            \App\Models\Role::insert($data);
        }
    }
}
