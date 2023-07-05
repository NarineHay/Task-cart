<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends BaseController
{
    // public function __construct()
    // {
    //     $this->middleware('client');
    // }

    public function login(Request $request)
    {


        // dd(env('PASSPORT_CLIENT_SECRET'));
        $response = Http::asForm()->post(url('/oauth/token'), [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);

        if($response->ok())
        {

            $data = $response->object();
            $user = Http::withHeaders([
                'Authorization' => 'Bearer ' . $data->access_token,
            ])->get(url('/api/user'));
            $data->user = $user->object();

            return response()->json($data,200);
        }
        else{
            return $this->sendError('error', 'Invalid email or id.');

        }

    }
}
