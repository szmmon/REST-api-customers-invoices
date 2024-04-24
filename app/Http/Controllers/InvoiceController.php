<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\InvoiceController as InvoiceApi;
use App\Http\Requests\V1\StoreFilterRequest;
use App\Models\Customer;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Response;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Http;
use App\Helpers\InvoiceHelpers;
use App\Http\Requests\V1\StoreInvoiceRequest;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $apiData = new InvoiceHelpers();
        // dd($apiData->invoicesDataNoFilters());
        return view('invoices.index', ['invoices' => $apiData->invoicesDataNoFilters(),
                                        'links' =>$apiData->pageLinks()]);
    }

    public function page(string $page)
    {
        $apiData = new InvoiceHelpers();
        return view('invoices.index', ['invoices' => $apiData->invoicesDataNoFilters($page),
                                        'links' =>$apiData->pageLinks()]);
    }

    public function filterResult(Request $request){
        $requestConverted = new InvoiceHelpers();
        
        return redirect()->action([InvoiceController::class,'filterApplied'], $requestConverted->convertFromForm($request));
    }

    public function filterApplied($id, $customerId, $status, $billedDate, $paidDate, $amountMin, $amountMax){
        $apiData = new InvoiceHelpers();
        return view('invoices.index', ['invoices' => $apiData->invoicesDataWithFilters($page=null, $id, $customerId, $status, $billedDate, $paidDate, $amountMin, $amountMax),
                                        'links' =>$apiData->pageLinks()]);
    }

    public function editInvoice(Invoice $invoice){
        return view('invoices.edit', [
            'invoice' => $invoice
        ]);
    }
    public function createInvoice(){
        return view('invoices.create');
    }
    public function storeInvoice(StoreInvoiceRequest $request){
        $data = new InvoiceHelpers();
        $response = $data->createInvoice($request);
        if ($response->ok()){
            redirect()->action([InvoiceController::class,'index'])->send();
        }
        else{
            redirect()->action([InvoiceController::class,'index'])->with('status', 'error')->send();
        }
    }

    public function updateInvoice(Request $request, Invoice $invoice){
        $apiCall = new InvoiceHelpers();
        $response = $apiCall->editInvoice($request, $invoice);
        if ($response->ok()){
            redirect()->action([InvoiceController::class,'index'])->send();
        }
        else{
            redirect()->action([InvoiceController::class,'index'])->with('status', 'error')->send();
        }
    }

}
