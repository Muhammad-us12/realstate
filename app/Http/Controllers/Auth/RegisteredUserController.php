<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }
    
    public function users_lists(){
        $users = User::all();
        return view('auth.users_lists',compact('users'));
    }
    
    public function user_update($id){
        $agentData = User::find($id);
        return view('auth.users_update',compact('agentData'));
    }
    
    public function update(Request $request, $id)
    {
        //
        // print_r($request->all());
        // die;
        $validated = $request->validate([
            
            'picture'=>'mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);
        

        if($request->file('picture')){
            
            $img_file = $request->file('picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/persons';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){

                $result = User::find($id)->update([
                'name' => $request->name,
                'user_rights' => json_encode( $request->agentRight),
                'img' =>$img_name,
                'status' => $request->status
                ]);     
            }
        }else{
            
            $result = User::find($id)->update([
                'name' => $request->name,
                'user_rights' => json_encode( $request->agentRight),
                'status' => $request->status
                ]);         
        }
        
        

        if($result){
            return redirect()->back()->with(['success'=>'User is updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user_img = '';
        if($request->file('picture')){
            
            $img_file = $request->file('picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/persons';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $user_img = $img_name;
              
                    
            }
        }
        
        // dd($request->all());
        $users_rights = json_encode( $request->agentRight);
        $user = User::insert([
            'name' => $request->name." ".$request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_rights' => $users_rights,
            'img' => $user_img,
            
        ]);
        
        if($user){
            return redirect('/users-list')->with(['success'=>'User is Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }

        
    }
}
