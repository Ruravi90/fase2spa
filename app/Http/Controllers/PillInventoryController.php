<?php

namespace fase2\Http\Controllers;

use Illuminate\Http\Request;

class PillInventoryController extends Controller
{
    public function index()
	{
		return view('pills_inventory.index');
	}
}
