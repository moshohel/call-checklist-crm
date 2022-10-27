<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use date;

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
    protected $redirectTo = RouteServiceProvider::USERS;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllUser()
    {
        // $users = User::orderBy('user_id', 'desc')->get();
        $users = DB::select("SELECT * FROM `vicidial_users` ORDER BY `user_id` DESC");
        // dd($users);
        return view('call_checklist.shojon.user.users')->with('users', $users);
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
            'full_name' => ['required', 'string', 'max:255'],
            'user' => ['required', 'unique:vicidial_users', 'string', 'max:255'],
            // 'user_type' => ['required', 'string', 'max:255'],
            'user_group' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data['image']->getClientOriginalName());
        // dd($data['image']);

        return User::create([
            'full_name' => $data['full_name'],
            'user' => $data['user'],
            'pass' => $data['password'],
            'user_group' => $data['user_group'],
            'image' => date('YmdHi') . $data['image']->getClientOriginalName(),
            'user_level' => 8,
            // 'password' => Hash::make($data['password']),
        ]);
        session()->flash('success', 'New User has added successfully !!');
    }

    public function register(Request $request)
    {
        // dd($request->file('image'));
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('Image/Profile'), $filename);
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user); //The line: $this->guard()->login($user); is where the user gets logged in auto

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
