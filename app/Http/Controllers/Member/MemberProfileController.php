<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Member;
// use App\Http\Requests\MemberRequest;
// use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class MemberProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $member = Member::where('user_id',auth()->user()->id)->first();
        $this->data['data'] = $member;
        return view('member.profile',$this->data);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        $user = User::findOrFail(Auth::user()->id);

        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'name' => 'required|string|max:255',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
            'phone' => 'required|unique:members,phone,'.$user->member->id
        ]); 
        

        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->name = $request->input('name');

        
        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                Session::flash('error', 'Data Gagal Disimpan');
            }
        }

        $member = Member::where('user_id',auth()->user()->id)->first();
        if ($member->update($params) && $user->save()) {
            Session::flash('success', 'Data Berhasil Disimpan');
        } else {
            Session::flash('error', 'Data Gagal Disimpan');
        }
        return redirect()->route('member.profile');
    }
}
