<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    private $response = [
        'message'   => null,
        'data'      => null
    ];

    public function login(Request $request)
    {
        $request->validate([
            'msnv'  => 'required',
            'password'  => 'required'
        ]);

        $user = User::where('msnv', $request->msnv)->first();

        if ( !$user || ! Hash::check($request->password, $user->password ) )
        {
            return response()->json([
                'message'   => 'failed',
                'data'      => 'MSNV or password is wrong'
            ]);
        }
        $token = $user->createToken($request->device_name)->plainTextToken;
        $this->response['message']  = 'success';
        $this->response['data']     = [
            'msnv'  => $request->msnv,
            'token' => $token
        ];
        return response()->json($this->response, 200);
    }

    public function me()
    {
        $user = Auth::user();

        $this->response['message']  = 'success';
        $this->response['data']     = $user;

        return response()->json($this->response, 200);
    }

    public function logout()
    {
        $logout = auth()->user()->currentAccessToken()->delete();
        $this->response['message'] = 'success';
        return response()->json($this->response, 200);
    }
}
