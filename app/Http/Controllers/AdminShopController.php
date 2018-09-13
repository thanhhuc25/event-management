<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminShopController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return view('admin.shops');
    }




}
