<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InvoiceHelpers{

    public function invoicesDataNoFilters(string $page=null){
        $invoices = $this->ApiCall($page);
        $invoicesData = $invoices->data;
        return $invoicesData;
    }
    public function apiCall(string $page=null, $filters=null){
                return $invoices = json_decode(Http::get('http://localhost:8000/api/V1/invoices?' . $page . $filters)->getBody()->__toString());
    }
    public function apiCallEdit(string $page=null, $filters=null){
                return $invoices = json_decode(Http::get('http://localhost:8000/api/V1/invoices?')->getBody()->__toString());
    }
    public function pageLinks(){
        $invoices = $this->apiCall();
        $links = $invoices->meta->links;
        $url = $this->pageLinksFormat($links);
        return $url;
    }

    public function invoicesDataWithFilters(string $page=null, $id, $customerId, $status, $billedDate, $paidDate, $amountMin, $amountMax){
        // dd([
        //     'id'=>$id, 
        //     'customer'=> $customerId, 
        //     's'=> $status, 
        //     'min' =>$amountMin, 
        //     'max' => $amountMax, 
        //     'bd' => $billedDate, 
        //     'pd' => $paidDate]);
        $filter = '';
        if ($id != ' '){
            $filter = $filter .  'id[eq]=' . $id . '&';
        }
        if ($customerId != ' '){
            $filter = $filter . 'customerId[eq]=' . $customerId . '&';
        }
        if ($status != ' '){
            $filter = $filter . 'status[eq]=' . $status . '&';
        }
        if ($billedDate != ' '){
            $filter = $filter . 'billedDate[eq]=' . $billedDate . '&';
        }
        if ($paidDate != ' '){
            $filter = $filter . 'paidDate[eq]=' . $paidDate . '&';
        }
        if ($amountMin != ' '){
            $filter = $filter . 'amount[gte]=' . $amountMin . '&';
        }
        if ($amountMax != ' '){
            $filter = $filter . 'amount[lte]=' . $amountMax . '&';
        }
        $invoices = $this->apiCall($page, $filter);
        $invoicesData = $invoices->data;
        // dd($invoicesData);
        return $invoicesData;
    }
    public function convertFromForm (Request $request){
        return [
        'id' => $id= $request['id']==null ? ' ' : $request['id'],
        'customerId' => $customerId = $request['customerId']==null ? ' ' : $request['customerId'],
        'status' => $status = $request['status']==null ? ' ' : $request['status'],
        'paidDate' => $paidDate = $request['paidDate']==null ? ' ' : $request['paidDate'],
        'billedDate' => $billedDate = $request['billedDate']==null ? ' ' : $request['billedDate'],
        'amountMin' => $amountMin = $request['amountMin']==null ? ' ' : $request['amountMin'],
        'amountMax' => $amountMax = $request['amountMax']==null ? ' ' : $request['amountMax'],
        ];
    }


    public function pageLinksFormat($links){
        for($i = 1; $i< count($links)-1; $i++){
            $url[$i] = $links[$i]->url;
            $url[$i] = str_replace("http://localhost:8000/api/V1/invoices?", '', $url[$i]);
        }
        return $url;
    }
}
