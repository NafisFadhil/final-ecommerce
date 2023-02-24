<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

		protected $guarded = ['id'];
		protected $casts = [
			'produk' => 'array'
		];

		public function user()
		{
			return $this->belongsTo(User::class);
		}

		public function kurir()
		{
			return $this->belongsTo(Kurir::class);
		}

		public function alamat()
		{
			return $this->belongsTo(Alamat::class);
		}

		public function komentar()
		{
			return $this->hasMany(Komentar::class);
		}

		public function setProdukAttribute($value)
		{
			$produk = [];

			foreach ($value as $key => $item) {
				if(isset($item['produk_id'])) {
					$produk[$key]['produk_id'] = $item['produk_id'];
					$produk[$key]['jumlah'] = $item['jumlah'];
				}
			}

			$this->attributes['produk'] = json_encode($produk);
		}
}
