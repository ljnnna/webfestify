<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function catalog()
    {
        return view('pages.customer.catalogcustomer');
    }
}
