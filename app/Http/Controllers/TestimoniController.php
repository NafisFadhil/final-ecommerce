<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Testimoni::where('user_id', auth()->user()->id)->get();

			return view('account.testimoni', [
				'testi' => $data
			]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.add-testimoni');
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
					'konten' => 'required'
				]);

				$validData['user_id'] = auth()->user()->id;

				if(count(Pesanan::where('user_id', auth()->user()->id)->where('is_send', true)->get()) > 0 && count(auth()->user()->testimoni) < 1) {
					Testimoni::create($validData);
					return redirect('/account/testimoni')->with('success', 'Testimoni berhasil ditambahkan');
				} 
				
				return redirect('/account/testimoni')->with('error', 'Anda sudah menulis testimoni atau anda belum membeli produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function show(Testimoni $testimoni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimoni $testimoni)
    {
      return view('account.edit-testimoni', [
				'testi' => $testimoni
			]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimoni $testimoni)
    {
			$validData = $request->validate([
				'konten' => 'required'
			]);

			$validData['user_id'] = auth()->user()->id;

			$testimoni->update($validData);
			
			return redirect('/account/testimoni')->with('success', 'Testimoni diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimoni  $testimoni
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimoni $testimoni)
    {
      $testimoni->delete();

			return redirect('/account/testimoni')->with('success', 'Testimoni berhasil dihapus');
    }
}
