<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

		protected $guarded = ['id'];

		protected $casts = [
			'rating' => 'array'
		];

		public function kategori()
		{
			return $this->belongsToMany(Kategori::class);
		}

		public function pesanan()
		{
			return $this->hasMany(Pesanan::class);
		}

		public function preview()
		{
			return $this->hasMany(Preview::class);
		}

		public function scopeFilter($query, array $filters)
		{
			$query->when($filters['search'] ?? false, fn($query, $search) => 
				$query->where('nama', 'like', '%'.$search.'%')
			);

			$query->when($filters['sort'] ?? false, function($query, $sort) {
				if($sort == 'latest') {
					return $query->latest();
				} else if($sort == 'featured') {
					return $query->orderBy('rating', 'desc');
				} else {
					false;
				}
			});

			$query->when($filters['category'] ?? false, fn($query, $category) => 
				$query->whereHas('kategori', function($query) use ($category) {
					$query->where('kategori_id', $category);
				})
			);
		}

		public function komentar()
		{
			return $this->hasMany(Komentar::class);
		}
}
