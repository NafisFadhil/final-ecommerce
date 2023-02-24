<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Banner::all();

			return view('account.banner', [
				'banners' => $data
			]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.add-banner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
					'gambar' => 'image|required',
					'posisi' => 'required|unique:banners'
				]);

				$validData['gambar'] = $request->file('gambar')->store('banner');

				Banner::create($validData);

				return redirect('/account/banners')->with('success', 'Banner berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('account.edit-banner', [
					'banner' => $banner
				]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
			$validData = $request->validate([
				'gambar' => 'image',
				'posisi' => 'required|unique:banners,posisi,'. $banner->id
			]);

			
			if($request->file('gambar')) {
				Storage::delete($banner->gambar);
				$validData['gambar'] = $request->file('gambar')->store('banner');
			}

			$banner->update($validData);

			return redirect('/account/banners')->with('success', 'Banner berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        Storage::delete($banner->gambar);

				$banner->delete();
				
				return redirect('/account/banners')->with('success', 'Banner berhasil dihapus');
    }
}
