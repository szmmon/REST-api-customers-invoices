<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\CustomerController as CustomerApi;
use App\Models\Customer;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $filter = '';
        $customers = json_decode(Http::get('http://localhost:8000/api/V1/customers?' . $filter)->getBody()->__toString());
        $customersData = $customers->data;
        $links = $customers->meta->links;
        for($i = 1; $i< count($links)-1; $i++){
            $url[$i] = $links[$i]->url;
            $url[$i] = str_replace("http://localhost:8000/api/V1/customers?", '', $url[$i]);
        }
        // dd($customersData);    
        return view('customers.index', ['customers' => $customersData,
                                        'links' =>$url]);
    }

    public function page(string $page)
    {
        $customers = json_decode(Http::get('http://localhost:8000/api/V1/customers?' . $page)->getBody()->__toString());
        $customersData = $customers->data;
        $links = $customers->meta->links;
        for($i = 1; $i< count($links)-1; $i++){
            $url[$i] = $links[$i]->url;
            $url[$i] = str_replace("http://localhost:8000/api/V1/customers?", '', $url[$i]);
        }
        // dd($url);    
        return view('customers.index', ['customers' => $customersData,
                                        'links' =>$url]);
    }

    public function filterResult(Response $query){
        dd($query);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
