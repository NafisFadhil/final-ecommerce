<?php 

namespace App\Helpers;

class GeneralHelper
{
	public static function toRupiah($price, $prefix = 'Rp')
	{
		return $prefix .' '. number_format($price, 0, ',', '.');
	}
}