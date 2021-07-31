<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        //xac thuc user co tai khoan chua
        $dataCheck = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($dataCheck)) {
            $checkTokenExist = SessionUser::where('id',Auth::id())->first();
            if(empty($checkTokenExist)){
                $userSession = SessionUser::create([
                    'user_id' => Auth::id(),
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expried' => date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+360 day'))
                ]);
            } else{
                return $userSession = $checkTokenExist;
            }
            return response()->json([
                'code' => 200,
                'data' => $userSession
            ], 200);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'username or password is incorrect'
            ], 401);
        }


        //tao token
    }


    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
