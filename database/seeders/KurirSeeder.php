<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('kurirs')->insert([
				['nama' => 'JNF', 'harga' => 23000],
				['nama' => 'GNT', 'harga' => 19000],
				['nama' => 'Anter', 'harga' => 1400],
			]);
    }
}
