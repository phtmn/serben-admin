<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enum\PapelEnum;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Administrador',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('123456'),
            'papel_id'  => PapelEnum::SERBEN
        ]);

        User::create([
            'name'      => 'Erico',
            'email'     => 'erico@wayapp.com.br',
            'password'  => bcrypt('erico@wayapp'),
            'papel_id'  => PapelEnum::SERBEN
        ]);
    }
}
