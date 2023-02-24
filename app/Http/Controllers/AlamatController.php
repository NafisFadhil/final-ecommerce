<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Alamat::where('user_id', auth()->user()->id)->get();

			return view('account.alamat', [
				'addresses' => $data
			]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.add-alamat');
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
					'alamat' => 'required'
				]);

				$validData['user_id'] = auth()->user()->id;

				Alamat::create($validData);

				return redirect('/account/address')->with('success', 'Alamat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Alamat $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Alamat $address)
    {
        return view('account.edit-alamat', [
					'address' => $address
				]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alamat  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alamat $address)
    {
      
			$validData = $request->validate([
				'alamat' => 'required'
			]);

			$validData['user_id'] = auth()->user()->id;

			$address->update($validData);

			return redirect('/account/address')->with('success', 'Alamat berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alamat  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alamat $address)
    {
        $address->delete();

				return redirect('/account/address')->with('success', 'Alamat berhasil dihapus');
    }
}
