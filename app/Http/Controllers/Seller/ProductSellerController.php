<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductSellerController extends Controller
{
    public function index()
    {
        return view('seller.product.create');
    }

    public function manage()
    {
        return view('seller.product.manage');
    }
}
