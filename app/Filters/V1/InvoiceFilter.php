<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoiceFilter extends ApiFilter{

    protected $allowedParms = [
    'customer_id' => ['eq'],
    'type' => ['eq'],
    'status' => ['eq', 'ne'],
    'billed_date' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    'paid_date' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    'amount' => ['eq', 'gt', 'lt', 'lte', 'gte']
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
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