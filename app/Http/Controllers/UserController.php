<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:3'
        ]);
        $user=new User();
        $user->name =$request->input('name');
        $user->email =$request->input('email');
        if (isset($request->password)){
            $user->password=Hash::make($request->password);
        }
        $user->save();
        return response()->json($user);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json(['result' => $user]);
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
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required',
        ]);
        $user=User::find($id);
        $user->name=$request->name;
        $user->save();

        return response()->json(['result'=>$user]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
        return response()->json(['Success' => 'success']);

    }
}
