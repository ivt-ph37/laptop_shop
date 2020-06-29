<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
use Validate;
use Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.user.register');

    }

    public function getLogin()
    {
        return view('user.user.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $this->validate($request, 
            [
                'fullname' => 'required|max:255',
                'email' => 'required|email|unique:users,email',
                'username' => 'required|max:16|unique:users,username',
                'password' => 'required|min:6|max:25',
                'confirm_password' => 'required|same:password',
                'telephone' => 'required|unique:users,telephone'
            ],
            [
                'email.required' => 'Please enter your email',
                'email.email' => 'Invalid email',
                'email.unique' => 'Email already exists',
                'username.unique' => 'Username already exists',
                'password.required' => 'Please enter your password',
                'confirm_password.same' => 'The password not the same',
                'password.min' => 'Password is at least 6 characters',
                'password.max' => 'Maximum password is no more than 25 characters',
                'telephone.unique' => 'Phone number already exists',
                'telephone.max' => 'Maximum phone number is no more than 10 numbers'
            ]
        );

        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->telephone = $request->telephone;
        $user->save();

        return redirect()->back()->with('success','Account successfully created');
    }

    public function setLogin(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:25'
            ],
            [
                'email.required' => 'Please enter your email',
                'email.email' => 'Invalid email',
                'password.required' => 'Please enter your password',
                'password.min' => 'Password is at least 6 characters',
                'password.max' => 'Maximum password is no more than 25 characters'
            ]
        );

        $credentials = array(
            'email'=>$request->email, 
            'password'=>$request->password
        );

        if(Auth::attempt($credentials)){
        
            if(Auth::user()->level != 0){
                return redirect()->route('category.index');
            }

            return redirect()->home()->with(['flag'=>'success', 'message'=>'Logged successfully']);
        }

        else 
            return redirect()->back()->with(['flag'=>'danger', 'message'=>'Login unsuccessful']);
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();

        // dd($user);
        return view('user.user.my_account', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('user.user.account_information', compact('user'));
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
        // $this->validate($request,
        //     [
        //         'telephone' => 'required|integer|max:10|unique:users,telephone'
        //     ],
        //     [
        //         'telephone.unique' => 'Phone number already exists',
        //         'telephone.max' => 'Maximum phone number is no more than 10 numbers'
        //     ],

        // );
        $user = User::find($request->id);
        
        $user->update($request->all());
        return redirect()->back()->with('success','Account successfully updated');
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
