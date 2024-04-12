<?php

namespace App\Http\Controllers;

class MyBillController extends Controller
{
    public function index()
    {
        return view('my-bills.index');
    }
}