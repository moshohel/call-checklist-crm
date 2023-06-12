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
use Illuminate\Support\Carbon;

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
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'email' => ['string', 'email', 'max:255', 'unique:vicidial_users'],
            // 'pass' => ['required', 'string', 'min:8'],
            'designation' => ['string', 'max:255', 'nullable'],
            'gender' => ['string', 'max:15', 'nullable'],
            'age' => ['numeric', 'max:110', 'nullable'],
            'contact_number' => ['numeric', 'max:99999999999'],
            'job_location' => ['string', 'max:255', 'nullable'],
            'bmdc_reg_number' => ['string', 'max:255', 'nullable'],

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

        $user = new User();
        $user->full_name = $data['full_name'];
        $user->user = $data['user'];
        $user->pass = $data['password'];
        $user->user_group = $data['user_group'];

        $user->email = $data['email'];
        $user->designation = $data['designation'];
        $user->gender = $data['gender'];
        $user->age = $data['age'];
        $user->contact_number = $data['contact_number'];
        $user->job_location = $data['job_location'];
        $user->bmdc_reg_number = $data['bmdc_reg_number'];
        // $user->contact_number_has_whatsapp = $data['contact_number_has_whatsapp'];


        if (array_key_exists("image", $data)) {
            $user->image = date('YmdHi') . $data['image']->getClientOriginalName();
        }

        if (array_key_exists("e_signature", $data)) {
            $user->e_signature = date('YmdHi') . $data['e_signature']->getClientOriginalName();
        }
        if ($user->user_group == "MHW") {
            $user->user_level = 1;
        } else {
            $user->user_level = 8;
        }
        $user->created_at = Carbon::now();

        return $user->save();

        // return User::create([
        //     'full_name' => $data['full_name'],
        //     'user' => $data['user'],
        //     'pass' => $data['password'],
        //     'user_group' => $data['user_group'],
        //     'image' => date('YmdHi') . $data['image']->getClientOriginalName(),
        //     'user_level' => 8,
        //     // 'password' => Hash::make($data['password']),
        // ]);

    }

    public function register(Request $request)
    {

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('Image/Profile'), $filename);
        }

        if ($request->file('e_signature')) {
            $file = $request->file('e_signature');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('Image/e_signature'), $filename);
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user); //The line: $this->guard()->login($user); is where the user gets logged in auto

        if ($response = $this->registered($request, $user)) {

            return $response;
        }
        session()->flash('success', 'New User has added successfully !!');
        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
