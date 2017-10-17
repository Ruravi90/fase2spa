<?php

namespace fase2\Http\Controllers;

use fase2\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        return view('user.index');
    }
}
