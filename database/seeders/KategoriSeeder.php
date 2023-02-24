<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('kategoris')->insert([
				['nama' => 'Pria'],
				['nama' => 'Wanita'],
				['nama' => 'Anak'],
			]);
    }
}
