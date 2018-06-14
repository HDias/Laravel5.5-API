<?php

namespace Sendler\Http\Controllers\API;

use Illuminate\Http\Request;
use Sendler\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json('Dashboard', 200);
    }
}
