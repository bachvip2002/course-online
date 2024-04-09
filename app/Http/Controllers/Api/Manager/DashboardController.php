<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;


/**
 * DashboardController of Pages ...
 */
class DashboardController extends Controller
{
    public function index()
    {
        return view('manager.page.dashboard-page');
    }
}
