<?php

namespace App\Http\Controllers;

class BillInformationController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.bill-informations.index', [
            'title' => 'Informasi Tagihan',
        ]);
    }
}
