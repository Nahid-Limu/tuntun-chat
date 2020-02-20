<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\User;
class ChatController extends Controller
{
    public function index()
    {
        // $a = 5;
        // $b = 1;
        // $array = [$a, $b];
        // sort($array);
        // $chattersId = (int)($array[0].$array[1]);
        // dd(gettype($chattersId));
        if(!empty($_GET['ReciverID']))
        {
            $reciverId = $_GET['ReciverID'];
            // session()->forget('rid');
            // session()->put('rid', $reciverId);
            // $reciverId = 100;
            // session()->get('rid')
            // return $reciverId;  
            $array = [Auth::user()->id, $reciverId];
            sort($array);
            $chattersId = (int)($array[0].$array[1]);

        }
        else{
            // session()->forget('rid');
            $reciverId = null;
            $chattersId = null;   
        }

        $users = DB::table('users')->get();
        $reciveUser = DB::table('users')->find($reciverId);
        $totalMsg = DB::table('messages')->where('chatters_id',$chattersId)->count();
        // $chats = DB::table('messages')->where('user_id',Auth::user()->id)->where('reciver_id',$reciverId)->get();
        $chats = DB::table('messages')->where('chatters_id',$chattersId)->get();
        
        // dd($users);
        return view('chat',compact('chats','users','reciveUser','totalMsg','reciverId'));
    }

    public function sentMsg(Request $request)
    {
        // return $request->all();
        $array = [Auth::user()->id, $request->reciverId];
        sort($array);
        $chattersId = (int)($array[0].$array[1]);

        DB::table('messages')->insert([
            'user_id' => Auth::user()->id,
            'reciver_id' => $request->reciverId,
            'chatters_id' => $chattersId,
            'message' => $request->msg,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString()
        ]);
        $data =Auth::user()->id;
        return response()->json($data);
    }

    


    public function chatReciverId(Request $request)
    {
        // $reciverId = $_GET['ReciverID'];
        if(!empty($_GET['ReciverID']))
        {
            $reciverId= $_GET['ReciverID'];   
        }
        else{
            $reciverId=100;   
        }
        return $reciverId;
    }

    public function logout($id)
    {
        // dd($id);
        $user = User::find($id);

        $user->active_status = 0;
        // $user->active_status = 0;

        $user->save();

        Auth::logout();
        return redirect('/login');
    }
}
