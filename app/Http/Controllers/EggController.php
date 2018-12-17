<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EggController extends Controller
{
    public function index()
    {
        return view('egg');
    }
}
