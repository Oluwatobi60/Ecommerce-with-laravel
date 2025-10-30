<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AffiliateCustomerController extends Controller
{
    public function index()
    {
        return view('customer.affiliate.my_affiliate');
    }
}
