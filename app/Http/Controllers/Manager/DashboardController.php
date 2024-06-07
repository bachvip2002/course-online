<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * DashboardController of Pages ...
 */
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.dashboard');
        }
    }
}
