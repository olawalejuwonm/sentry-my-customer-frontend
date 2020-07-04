<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Store;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Store::where('store_admin', Cookie::get('user_id'))->get();
        return view('backend.stores.index')->with('response', $response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'store_name' => 'required',
            'phone_number' => 'required',
            'tagline' => 'required',
            'shop_address' => 'required',
        ]);

        Store::create([
            'store_name' => $request->store_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'tagline' => $request->tagline,
            'shop_address' => $request->shop_address,
            'store_admin' => Cookie::get('user_id'),
        ]);

        return redirect()->route('store.create')->with('success-alert', 'Store was successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('backend.stores.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        return view('backend.stores.edit')->with('store', $store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $store)
    {
        $request->validate([
            'store_name' => 'required',
            'phone_number' => 'required',
            'tagline' => 'required',
            'shop_address' => 'required',
        ]);

        Store::where('_id', $store)->update([
            'store_name' => $request->store_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'tagline' => $request->tagline,
            'shop_address' => $request->shop_address,
        ]);

        return redirect()->route('store.index')->with('success-alert', 'Store was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
