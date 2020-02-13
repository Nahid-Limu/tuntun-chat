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

        }
        else{
            // session()->forget('rid');
            $reciverId = null;   
        }

        $users = DB::table('users')->get();
        $reciveUser = DB::table('users')->find($reciverId);
        $totalMsg = DB::table('messages')->where('user_id',Auth::user()->id)->where('reciver_id',$reciverId)->count();
        $chats = DB::table('messages')->where('user_id',Auth::user()->id)->where('reciver_id',$reciverId)->get();
        
        // dd($users);
        return view('chat',compact('chats','users','reciveUser','totalMsg','reciverId'));
    }

    public function sentMsg(Request $request)
    {
        // return $request->all();
        DB::table('messages')->insert([
            'user_id' => Auth::user()->id,
            'reciver_id' => $request->reciverId,
            'message' => $request->msg,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString()
        ]);
        $data =Auth::user()->id;
        return response()->json($data);
    }

    public function profile()
    {
        $chats = DB::table('messages')->get();
        $user = DB::table('users')->find(Auth::user()->id);
        // dd($chats);
        return view('profile');
    }
    public function Updateprofile(Request $request)
    {
        // dd($request->all());
        $user=DB::table('users')->where('id','=',Auth::user()->id)->first();
        $image=$user->image;
        if($request->hasFile('image') && $image!=null){
            $path = public_path() . "/userImage/" . $image;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        if($file=$request->file('image')){
            if($request->file('image')->getClientSize()>2000000)
            {
                // Session::flash('error','Could Not Upload. File Size Limit Exceeded.');
                // return redirect()->back();
                return redirect()->back()->with('message', 'Could Not Upload. File Size Limit Exceeded.');
                // return response()->json(['error' => 'Could Not Upload. File Size Limit Exceeded.']);
            }
            $name=$user->name.'-ProfileImage'.'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move('userImage',$name);
            DB::table('users')->where('id','=',Auth::user()->id)->update([
                'image'=>$name,
                'on_your_mind'=>$request->on_your_mind,
            ]);
        }else {
            DB::table('users')->where('id','=',Auth::user()->id)->update([
                'on_your_mind'=>$request->on_your_mind,
            ]);
        }
        // Session::flash('success','Image Updated');
        // return redirect()->back();
        return redirect()->back()->with('message', 'Profile Picture Update Successfully.');
        // return view('profile');
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
