<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return 'index';
    }
 
    public function store(Request $request)
    {
        return 'store';
    }
}
