<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Controllers\Controller;
use FontLib\Table\Type\post;

class UserController extends Controller
{
    public $image = '';
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user =  DB::table('vicidial_users')
            ->where('user_id', '=', $user_id)
            ->get();

        return view('call_checklist.shojon.user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        // $user_id = $id;
        // $user = User::find($user_id);
        $user =  DB::table('vicidial_users')
            ->where('user_id', '=', $user_id)
            ->get();
        // $user = DB::select("SELECT * FROM `vicidial_users` where `user_id` = $id");

        // dd($user);
        return view('call_checklist.shojon.user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        global $image;

        // Post::where('id', 3)->$data = array();
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('Image/Profile'), $filename);
        }

        // if ($request->image) {
        //     $image = $request->image;
        // }

        // $full_name = $request->full_name;
        // $user_name = $request->user;
        // $pass = $request->client_name;
        // $user_group = $request->user_group;

        // $data = array('image' => $image, "full_name" => $full_name, "user" => $user_name, "user_group" => $user_group);

        // $user = User::find($user_id);
        // $user = User::whereUserId($user_id)->get();
        $user = User::where('user_id', $user_id)->first();
        // dd($user);
        // dd($user->user_id);
        $data = $request->only($user->getFillable());
        if ($request->file('image')) {
            $data['image'] = date('YmdHi') . $data['image']->getClientOriginalName();
        }
        // print_r($data['name'], '\n');
        // dd($data);
        // $name = $data['name'];
        // $rowPass = $data['password'];
        // if ($data['password'] != '') {
        //     print($data['password']);
        //     echo '</br>';
        //     // $data['password'] =  Hash::make($request->password);
        //     $options = [
        //         'cost' => 10,
        //     ];
        //     $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, $options);
        //     print_r($data['password']);
        //     echo '</br>';

        //     // echo password_hash($data['password'], PASSWORD_BCRYPT, $options);
        // } else {
        //     unset($data['password']);
        // }
        $user->fill($data);
        $user->save();

        session()->flash('success', 'User credentials changed successfully !!');
        // redirect('/edit/{{$id}}');
        return redirect()->to('edit/' . $user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}