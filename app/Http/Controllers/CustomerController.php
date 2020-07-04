<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator as Paginator; // NAMESPACE FOR PAGINATOR
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Store;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $collection['customers'] = Customer::whereIn('store', 
                        Store::where('store_admin', 
                                    Cookie::get('user_id')
                                )->pluck('_id')
                    )->paginate(10);

        $collection['stores'] = Store::where('store_admin', Cookie::get('user_id'))->get();

        return view('backend.customer.index')->with('collection', $collection);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_customer(Request $request)
    {
        return Customer::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'store' => $request->store_name,
            'email' => $request->email,
        ]);
    }
        
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'store' => 'required',
            'email' => 'required|unique:customers,email',
        ]);

        Customer::create($validated);

        return redirect()->route('customer.index')->with('success-alert', 'Your customer was successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewCustomer($id)
    {
        //
        if ( !$id || empty($id) ) {
            return view('errors.500');
        }

        try {
            $url = $this->host.'customer/'.$id;
            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request("GET", $url, $headers);
            $data = json_decode($response->getBody());

            if ( $response->getStatusCode() == 200 ) {
                return view('backend.customer.show')->with('response', $data->data);
            } else {
                return view('errors.500');
            }
        } catch ( \Exception $e ) {
            return view('errors.500');
        }
    }
    
    public function show($id)
    {
        return view('backend.customer.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if ( !$id || empty($id) ) {
            return view('errors.500');
        }

        try {
            $url = $this->host.'customer/'.$id;
            $client = new Client;
            $headers = ['headers' => ['x-access-token' => Cookie::get('api_token')]];
            $response = $client->request("GET", $url, $headers);
            $data = json_decode($response->getBody());
            
            if ( $response->getStatusCode() == 200 ) {
                return view('backend.customer.edit')->with('response', $data->data);
            } else {
                return view('errors.500');
            }
        } catch ( \Exception $e ) {
            return view('errors.500');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ( !$id || empty($id) ) {
            return view('errors.500');
        } else if ( !isset($request->name) || !isset($request->phone ) ) {
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', 'Name and Phone number are required');

            return redirect()->back();
        }

        try {
            $url = $this->host.'customer/update/'.$id;
            $client = new Client;
            $payload = [
                'headers' => ['x-access-token' => Cookie::get('api_token')],
                'form_params' => [
                    'name' => $request->name,
                    'phone' => $request->phone
                ]
            ];
            $response = $client->request("PUT", $url, $payload);
            $data = json_decode($response->getBody());
            
            if ( $response->getStatusCode() == 200 ) {
                $request->session()->flash('alert-class', 'alert-success');
                $request->session()->flash('message', 'Customer updated successfully');
            
                return redirect()->back();
            } else {
                $request->session()->flash('alert-class', 'alert-danger');
                $request->session()->flash('message', 'Customer update failed');
            }

        } catch ( \Exception $e ) {
            $data = json_decode($e->getBody()->getContents());
            $request->session()->flash('alert-class', 'alert-danger');
            $request->session()->flash('message', $data->message);

            return redirect()->back();
        }
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
