<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\persons\Agent;
use Hash;

use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        return view('auth.login');
    }

    public function changePassword(){
        return view('auth.changePassword');

    }

    public function updatePassword(Request $request){
        $validated = $request->validate([
            
            'password' => 'required|confirmed|min:8',
            
        ]);
        
        $user = User::where('id',Auth::user()->id)->first();
        if(Hash::check($request->prev_password, $user->password)){
            $user->password = Hash::make($request->password);
            $result = $user->update();

            if($result){
                return redirect()->back()->with(['success'=>'Your Password is Updated Successfully']);
            }
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);

        }else{
            return redirect()->back()->with(['error'=>'Your Previous Password is Wrong']);
        }
    }

    public function agentLogin(){
        return view('auth.agentLogin');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user_data = User::where('email',$request->email)->where('status','active')->first();
        if(isset($user_data)){
           $request->authenticate();

            $request->session()->regenerate();
        }else{
             return redirect()->back()->with('Your Are Blocked');
        }
        
        // print_r($user_data);
        // echo "sub";
        // die;
        

        // return redirect()->intended(RouteServiceProvider::HOME);
        return redirect('/dashboard');
    }

    public function agentLoginSubmit(LoginRequest $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (\Auth::guard('agent')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])){
            return redirect()->intended('/agent-dashboard');
        }
        // $request->authenticate();

        // $request->session()->regenerate();

        // // return redirect()->intended(RouteServiceProvider::HOME);
        return redirect('/agent-login')->with(['error'=>'These credentials do not match our records.']);
    }

    public function agent_Login(LoginRequest $request)
    {
        // dd($request);
        // $request->authenticate();
        if (Auth::guard('agent')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('agent_dashboard')->with('login Successfully');
        }

        return redirect('/agent-login')->with(['error'=>'These credentials do not match our records.']);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
