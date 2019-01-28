<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $data = 'hello';
        // $data2 = 'hello';
        // $my_arr = array( 'name' => 'test' );
        // return view('home', ['data' => $data, 'data2' => $data2, 'my_arr' => $my_arr]);
      //  return('home');
    }

   
    

//         public function myHome()

//         {

//             return view('myHome');

//         }


// public function myUsers()

//         {
//             $users =User::get();
             
//         return view('myUsers', compact('users'));
          

//         }


//         public function allUsers(){
//             $users =User::get();
             
//              print_r($users);
//         }


}
