<?php

namespace App\Http\Controllers\Client;

use App\Exceptions\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * AuthenticationController of Pages ...
 */
class AuthenticationController extends Controller
{
    /**
     * Method signInPage
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function signInPage()
    {
        return view('manager.page.authentication.sign-in');
    }

    /**
     * Method login
     *
     * @param Request $request [explicite description]
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws App\Exceptions\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['id_login', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return response()->json([
                'user' => Auth::guard('admin')->user()
            ], Response::HTTP_ACCEPTED);
        }

        throw new JsonResponse([
            'message' => 'Không đúng tài khoản mật khẩu'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('manager.authentication.sign-in-page');
    }
}
