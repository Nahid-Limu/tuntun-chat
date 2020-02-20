<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
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
}
