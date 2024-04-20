<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomerFilter extends ApiFilter{
    protected $allowedParms = [
    'name' => ['eq'],
    'type' => ['eq'],
    'email' => ['eq'],
    'city' => ['eq'],
    'address' => ['eq'],
    'postalCode' => ['eq', 'gt', 'lt', 'lte', 'gte']
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '>',
        'lte' => '>=',
        'gt' => '<',
        'gte' => '<=',
    ];
}