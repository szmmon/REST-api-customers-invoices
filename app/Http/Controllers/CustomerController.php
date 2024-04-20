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
use App\Helpers\CustomerHelpers;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $apiData = new CustomerHelpers();

        return view('customers.index', ['customers' => $apiData->customersDataNoFilters(),
                                        'links' =>$apiData->pageLinks()]);
    }

    public function page(string $page)
    {
        $apiData = new CustomerHelpers();

        return view('customers.index', ['customers' => $apiData->customersDataNoFilters($page),
                                        'links' =>$apiData->pageLinks()]);
    }

    public function filterResult(Request $request){
        $requestConverted = new CustomerHelpers();
        
        return redirect()->action([CustomerController::class,'filterApplied'], $requestConverted->convertFromForm($request));
    }

    public function filterApplied($type, $email, $name, $city, $address, $postalCodeMin, $postalCodeMax,){
        $apiData = new CustomerHelpers();

        return view('customers.index', ['customers' => $apiData->customersDataWithFilters(null,$type, $email, $name, $city, $address, $postalCodeMin, $postalCodeMax),
                                        'links' =>$apiData->pageLinks()]);
    }
    
}
