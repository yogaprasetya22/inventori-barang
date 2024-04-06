<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        // create kategori 
        $kategori = ['Oli', 'Ban', 'Aki', 'Kampas Rem', 'Busi'];
        foreach ($kategori as $k) {
            \App\Models\Kategori::create([
                'nama_kategori' => $k,
            ]);
        }

        $this->call([
            SupplierSeeder::class,
        ]);

        //
        $roles = [
            [
                'name_role' => 'admin',
            ],
            [
                'name_role' => 'owner',
            ],
            [
                'name_role' => 'mekanik',
            ],
        ];

        // create data roles
        Role::insert($roles);


        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('asdasdasd'),
            'role_id' => '1',
            'created_at' => now(),
        ]);

        User::create([
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('asdasdasd'),
            'role_id' => '2',
            'created_at' => now(),
        ]);

        User::create([
            'name' => 'mekanik',
            'email' => 'mekanik@gmail.com',
            'password' => bcrypt('asdasdasd'),
            'role_id' => '3',
            'created_at' => now(),
        ]);
    }
}
