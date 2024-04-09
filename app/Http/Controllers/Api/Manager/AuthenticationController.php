<?php

namespace App\Http\Controllers\Api\Manager;

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
    public function renderSignInPage()
    {
        return view('manager.page.authentication.sign-in-page');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['id_login', 'password']);

        $authSuccessful = Auth::guard('admin')
            ->attempt($credentials);

        if ($authSuccessful) {
            return response()->json([
                'user' => Auth::guard('admin')->user()
            ], Response::HTTP_ACCEPTED);
        }

        throw new JsonResponse([
            'message' => 'Không đúng tài khoản mật khẩu'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        Auth::guard('admin')
            ->logout();

        return redirect()->route('manager.authentication.sign-in-page');
    }
}
