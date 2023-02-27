<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'fio' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response(
                [
                    'error' => [
                        'code' => 422,
                        'message' => 'Validation error',
                        'errors' => $validator->errors()
                    ]
                ], 422
            );
        }


        $user = User::create($input);
        $token = $user->user_token = Str::random(60);
        $user->save();

        return response([
            'data' => [
                'user_token' => $token
            ]
        ]);

//        $user = User::create([
//            'fio' => $request->input('fio'),
//            'email' => $request->input('email'),
//            'password'=>$request->input('password'),
//            'user_token' => $token,
//            'role_id' => null
//        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        $userSession = session(['user_id' => $user->id]);

        if (!$user) return response()->json([
            'error' => [
                'code' => 401,
                'message' => 'Authentication failed'
            ]
        ], 401);


        return response()->json(
            [
                'data' => [
                    'user_token' => $user->user_token
                ]
            ]
        );


    }

    public function TestSession(Request $request)
    {
    }

    public function logout(Request $request)
    {
//        $user->user_token->delete();
//
//        return response()->json([
//            'data' => [
//                'message' => 'logout'
//            ]
//        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
