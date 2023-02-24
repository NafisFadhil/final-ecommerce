<?php

namespace Database\Seeders;

use App\Models\Preview;
use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$product = Produk::all();

			foreach ($product as $pr) {
				Preview::create([
					'produk_id' => $pr->id,
					'gambar' => 'default.jpg'
				]);
			} 
    }
}
