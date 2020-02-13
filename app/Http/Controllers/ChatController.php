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
        $chats = DB::table('messages')->get();
        $users = DB::table('users')->get();
        // dd($users);
        return view('chat',compact('chats','users'));
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