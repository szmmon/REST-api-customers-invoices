<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerHelpers{

    public function customersDataNoFilters(string $page=null){
        $customers = $this->ApiCall($page);
        $customersData = $customers->data;
        return $customersData;
    }

    public function pageLinks(){
        $customers = $this->ApiCall();
        $links = $customers->meta->links;
        $url = $this->pageLinksFormat($links);
        return $url;
    }

    public function customersDataWithFilters(string $page=null, $type, $email, $name, $city, $address, $postalCodeMin, $postalCodeMax){
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
        $customers = $this->ApiCall($page, $filter);
        $customersData = $customers->data;
        return $customersData;
    }

    public function convertFromForm (Request $request){
        return [
        'type' => $type= $request['type']==null ? ' ' : $request['type'],
        'name' => $name = $request['name']==null ? ' ' : $request['name'],
        'email' => $email = $request['email']==null ? ' ' : $request['email'],
        'city' => $city = $request['city']==null ? ' ' : $request['city'],
        'address' => $address = $request['address']==null ? ' ' : $request['address'],
        'postalCodeMin' => $postalCodeMin = $request['postalCodeMin']==null ? ' ' : $request['postalCodeMin'],
        'postalCodeMax' => $postalCodeMax = $request['postalCodeMax']==null ? ' ' : $request['postalCodeMax'],
        ];
    }


    
        public function apiCall(string $page=null, $filter=null){
        return $customers = json_decode(Http::get('http://localhost:8000/api/V1/customers?' . $page . $filter)->getBody()->__toString());
    }

    public function pageLinksFormat($links){
        for($i = 1; $i< count($links)-1; $i++){
            $url[$i] = $links[$i]->url;
            $url[$i] = str_replace("http://localhost:8000/api/V1/customers?", '', $url[$i]);
        }
        return $url;
    }
}