<?php

namespace fase2\Http\Controllers;

use Illuminate\Http\Request;

class ProductInventoryController extends Controller
{
    public function index()
	{
		return view('products_inventory.index');
	}
}
