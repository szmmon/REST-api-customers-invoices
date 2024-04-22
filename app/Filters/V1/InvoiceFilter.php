<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoiceFilter extends ApiFilter{

    protected $allowedParms = [
    'id' => ['eq'], 
    'customerId' => ['eq'],
    'status' => ['eq', 'ne'],
    'billedDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    'paidDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    'amount' => ['eq', 'gt', 'lt', 'lte', 'gte']
    ];

    protected $columnMap = [
        'paidDate' => 'paid_date',
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];
}