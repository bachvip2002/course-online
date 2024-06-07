<?php

namespace App\Http\Controllers\Manager;

use App\Exceptions\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * AuthenticationController of Pages ...
 */
class AuthenticationController extends Controller
{
    public function signIn(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'message' => 'success'
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.authentication.sign-in');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['id_login', 'password']);

        $authSuccessful = Auth::guard('admin')
            ->attempt($credentials);

        if ($authSuccessful && $request->ajax()) {
            return response()->json([
                'user' => Auth::guard('admin')->user()
            ], Response::HTTP_ACCEPTED);
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Không đúng tài khoản mật khẩu'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')
            ->logout();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'success'
            ], Response::HTTP_ACCEPTED);
        } else {
            return redirect()->route('manager.authentication.sign-in');
        }
    }
}
