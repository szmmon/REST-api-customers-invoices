<?php

namespace App\Helpers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use LaravelDaily\Invoices\Invoice as InvoicePdf;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceGenerateHelpers{
    
    public function generateInvoice(Invoice $invoice){
        $customerRequest = json_decode(Http::get('http://localhost:8000/api/V1/customers/'. $invoice->customer_id )->getBody()->__toString());
        $customerData = $customerRequest->data;
        $customer = new Buyer([
        'name' => $customerData->name,
        'custom_fields' => [
            'email' => $customerData->email,
            'city' => $customerData->city,
            'address' => $customerData->address,
            'postalCode' => $customerData->postalCode,
        ],
        ]);
        $client = new Party([
            'name'          => 'Roosevelt Lloyd',
            'phone'         => '(520) 318-9486',
            'custom_fields' => [
            'note'        => 'IDDQD',
            'business id' => '365#GG',
            ],
        ]);

        $items = [
        InvoiceItem::make('Service')->pricePerUnit($invoice->amount)->quantity(1)
        ];
        if ($invoice->status == 'P'){
            $invoicePdf = InvoicePdf::make('receipt')
            ->status(__('invoices::invoice.paid'))
            ->seller($client)
            ->buyer($customer)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items);
        }else{
            $invoicePdf = InvoicePdf::make('receipt')
            ->status(__('invoices::invoice.due'))
            ->seller($client)
            ->buyer($customer)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items);
        }
        return $invoicePdf->stream();
        }

    }

