<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Produk;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index()
		{
			$featured = Produk::filter(['sort' => 'featured'])->limit(4)->get();
			$latest = Produk::filter(['sort' => 'latest'])->limit(4)->get();
			$banner = Banner::orderBy('posisi', 'desc')->get();
			$testi = Testimoni::all();

			return view('index', [
				'featured' => $featured,
				'latest' => $latest,
				'banner' => $banner,
				'testi' => $testi
			]);
		}
}
