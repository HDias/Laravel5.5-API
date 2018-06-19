<?php

namespace API\Http\Controllers\API;

use Illuminate\Http\Request;
use API\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json('Dashboard', 200);
    }
}
