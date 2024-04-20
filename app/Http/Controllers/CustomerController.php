<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\CustomerController as CustomerApi;
use App\Http\Requests\V1\StoreFilterRequest;
use App\Models\Customer;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Response;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        if(session()->has('type')){
            // dd(session()->all());
            $customers = json_decode(Http::get('http://localhost:8000/api/V1/customers?type[eq]=' . session('type'))->getBody()->__toString());
        }
        else{
        $customers = json_decode(Http::get('http://localhost:8000/api/V1/customers?')->getBody()->__toString());
        }
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

    public function filterResult(Request $request){
        $type= $request['type']==null ? ' ' : $request['type'];
        $name = $request['name']==null ? ' ' : $request['name'];
        $email = $request['email']==null ? ' ' : $request['email'];
        $city = $request['city']==null ? ' ' : $request['city'];
        $address = $request['address']==null ? ' ' : $request['address'];
        $postalCodeMin = $request['postalCodeMin']==null ? ' ' : $request['postalCodeMin'];
        $postalCodeMax = $request['postalCodeMax']==null ? ' ' : $request['postalCodeMax'];
        
        return redirect()->action([CustomerController::class,'filterApplied'], [
        'type'=> $type,
        'name' => $name,
        'email' => $email,
        'city' => $city,
        'address' => $address,
        'postalCodeMin' => $postalCodeMin,
        'postalCodeMax' => $postalCodeMax,
        ]);
    }

    public function filterApplied($type, $email, $name, $city, $address, $postalCodeMin, $postalCodeMax,){
        $filter = '';
        if ($type != ' '){
            $filter = $filter .  'type[eq]=' . $type . '&';
        }
        if ($email != ' '){
            $filter = $filter . 'email[eq]=' . $email . '&';
        }
        if ($name != ' '){
            $filter = $filter . 'name[eq]=' . $name . '&';
        }
        if ($city != ' '){
            $filter = $filter . 'city[eq]=' . $city . '&';
        }
        if ($address != ' '){
            $filter = $filter . 'address[eq]=' . $address . '&';
        }
        if ($postalCodeMin != ' '){
            $filter = $filter . 'postalCode[gte]=' . $postalCodeMin . '&';
        }
        if ($postalCodeMax != ' '){
            $filter = $filter . 'postalCode[lte]=' . $postalCodeMax . '&';
        }
        $customers = json_decode(Http::get('http://localhost:8000/api/V1/customers?' . $filter)->getBody()->__toString());
        // dd([$type, $email, $name, $city, $address, $postalCodeMin, $postalCodeMax]);
        $customersData = $customers->data;
        $links = $customers->meta->links;
        for($i = 1; $i< count($links)-1; $i++){
            $url[$i] = $links[$i]->url;
            $url[$i] = str_replace("http://localhost:8000/api/V1/customers?", '', $url[$i]);
        }
        return view('customers.index', ['customers' => $customersData,
                                        'links' =>$url]);
    }
    
}
