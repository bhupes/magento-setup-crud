<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Http\Resources\User as UserResources;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    protected $tokenName;

    public function __construct()
    {
        $this->tokenName = env('TOKEN_NAME') ?? "Laravel-Api";
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $input['is_active'] = User::isTrue;
        $input['is_deleted'] = User::isFalse;

        $user = User::create($input);
        $success['token'] =  $user->createToken($this->tokenName)->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['id'] =  $user->id;
            $success['name'] =  $user->name;
            $success['token'] =  $user->createToken($this->tokenName)->plainTextToken;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * Logout api to removing tokens
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->sendResponse([], 'User logout successfully.');
    }

    public function profile()
    {
        try {
            $user = auth()->user();

            return $this->sendResponse(
                [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone_number' => $user->phone_number
                ],
                'User details retrived successfully.'
            );
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }
}
