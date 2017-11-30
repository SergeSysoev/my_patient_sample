<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return array
     */
    protected function create(array $data)
    {
        $user = User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $staff =  Staff::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'sex' => $data['sex'],
            'user_id' => $user->id,
            'role_id' => $data['role_id'],
        ]);
        return ['user_id' => $user, 'staff_id' => $staff];
    }

    public function postRegister(Request $request)
    {
        if($request->isJson())
        {
            $data = (array)json_decode(json_encode($request->all()));
            if($ids = $this->create($data))
            {
                return $this->json(200, 'Registration is successful!', $ids);
            }
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong',
                'debug' => $request
            ]);
        }
//        $validator = $this->validator($request->all());

//        if ($validator->fails()) {
//            $this->throwValidationException(
//                $request, $validator
//            );
//        }

        return response()->json([
            'status' => 501,
            'debug' => $request
        ]);
    }
}
