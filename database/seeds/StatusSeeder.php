<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Запланирована'],
            ['name' => 'В работе'],
            ['name' => 'Завершена'],
            ['name' => 'Отложена'],
            ['name' => 'Отменена']
        ];

        if (!\App\Models\Status::get()->count()) {
            \App\Models\Status::insert($data);
        }
    }
}
