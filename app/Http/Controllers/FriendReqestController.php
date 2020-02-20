<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FriendReqestController extends Controller
{
    public function requestList()
    {
        // $reqs = DB::table('users')->where('active_status',3)->get();
        // // return view('requestList',compact('reqs'));
        // return view('requestList',compact('reqs'));

        $friendsRequest = DB::table('users')->where('active_status',3)->get();
        //dd($department);
        return view('requestList',compact('friendsRequest'));
    }

    
}
