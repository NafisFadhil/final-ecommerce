<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use App\Models\Preview;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
				\App\Models\User::create([
					'name' => 'admin',
					'email' => 'admin@admin.com',
					'username' => 'admin',
					'phone' => '080808080808',
					'password' => Hash::make('admin123'),
					'is_admin' => true
				]);
				\App\Models\User::create([
					'name' => 'Nafis Fadhil',
					'username' => 'Nafis',
					'phone' => '08970573070',
					'email' => 'nafis@gmail.com',
					'password' => Hash::make('nafis123'),
					'is_admin' => false
				]);

				$this->call([
					KategoriSeeder::class,
					ProdukSeeder::class,
					KurirSeeder::class,
					BannerSeeder::class,
					PreviewSeeder::class
				]);
    }
}
