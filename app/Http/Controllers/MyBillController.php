<?php

namespace App\Http\Controllers;

class MyBillController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.my-bills.index');
    }
}
