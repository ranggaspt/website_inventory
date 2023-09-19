<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\MemberRequest;
use App\Models\User;
use App\Models\Member;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Nette\Utils\DateTime;

use PDF;
use Barryvdh\DomPDF\Facade;




class AdminMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::latest()->get();
        $this->data['members'] = $members;
        return view('admin.member.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request1,UserRequest $request2)
    {
        $params1 = $request1->all();
        $params2 = [
            'name' => $request2->name,
            'email' => $request2->email,
            'username' => $request2->username,
            'password' => Hash::make($request2->password),
            'role' => 'member'
        ];
        $user = User::create($params2);
        if($user){
            $params1['user_id'] = $user->id;
            if (Member::create($params1)) {
                alert()->success('Success','Data Berhasil Disimpan');
            } else {
                $user = User::findOrFail($user->id);
                $user->delete();
                alert()->error('Error','Data Gagal Disimpan');
            }
        }
        return redirect('admin/member');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $member;
        return view('admin.member.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $memberParams = $request->except('email','username', 'password');
        $userParams = [
            'email' => $request->email,
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        if ($request->filled('password')) {
            $userParams['password'] = Hash::make($request->password);
        }

        $member = Member::findOrFail(Crypt::decrypt($id));
        $user = User::findOrFail($member->user_id);

        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'name' => 'required|string|max:255',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'phone' => 'required|unique:members,phone,'.$user->member->id,
        ]);

        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->name = $request->input('name');

        // Lakukan pembaruan data
        if ($member->update($memberParams) && $user->update($userParams)) {
            Session::flash('success', 'Data Berhasil Disimpan');
        } else {
            Session::flash('error', 'Data Gagal Disimpan');
        }

        return redirect()->route('admin.member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail(Crypt::decrypt($id));
        if ($member->delete()) {
            $user = User::findOrFail($member->user_id);
            $user->delete();
            alert()->success('Success','Data Berhasil Dihapus');
        } else {
            alert()->error('Error','Data Gagal Dihapus');
        }
        return redirect('admin/member');
    }

    public function generatepdf(){
        $members = Member::all();
        $pdf = PDF::loadView('admin.member.export', ['members' => $members])-> setOptions(['defaultFont' => 'sans-serif']);;

        return $pdf->stream('Laporan Data Member');
        // return $pdf->stream();
    }
}
