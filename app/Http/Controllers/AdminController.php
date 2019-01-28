<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function admin()
    {
        return view('admin');
    }

    public function myUsers()

        {


            $users = DB::table('users')
            ->leftjoin('download_csv', 'users.id', '=', 'download_csv.u_id')
            ->select('users.*',DB::raw('count(download_csv.u_id) as download_count'))
            ->groupBy('users.id')
            ->get();
          
             
        return view('myUsers', compact('users'));
          

        }






public function edit($id)
    {
        $user = User::find($id);

        return view('theme.edit', compact('user'));
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
      // $request->validate([
      //   'share_name'=>'required',
      //   'share_price'=> 'required|integer',
      //   'share_qty' => 'required|integer'
      // ]);

      $user = User::find($id);
      $user->name = $request->get('name');
      $user->email = $request->get('email');
      $user->type = $request->get('type');
      $user->status = $request->get('status');
      $user->save();

      return redirect('/admin')->with('success', 'user has been updated');
}


 public function destroy($id)
    {
       $user = User::find($id);
       $user->delete();

     return redirect('/admin')->with('success', 'User has been deleted Successfully');
}

}
