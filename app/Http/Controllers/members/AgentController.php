<?php

namespace App\Http\Controllers\members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\persons\Agent;
use App\Models\User;
use App\Models\persons\AgentBalance;
use App\Models\persons\AgentLedeger;
use Hash;
use Auth;
use DB;


class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
                // $agentBalance = Agent::find(8)->AgentBalance;
                // print_r($agentBalance);
                // die;
                $agentData = Agent::orderBy("id","desc")->paginate(10);
                $users = User::where('role','admin')->get();
                // dd($users);
                return view('adminPanel.members.agentList',compact('agentData','users'));
    }

    public function fetch_agent_bal($id)
    {
    //    echo "The id is $id";
       $AgentBalance = AgentBalance::where('agent_id',$id)->first();
       return $AgentBalance->balance;
    //    print_r($accountBalance);
    }

    public function fetch_agent_list(){
        $agentData = Agent::all();
        return $agentData;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countriesList = DB::table('country')->get();
        return view('adminPanel.members.addAgent',compact('countriesList'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'email' => 'required|max:250|unique:agents',
            'password' => 'required|confirmed|min:8',
            'city' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'balance' => 'required|integer',
            'picture'=>'required|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        
        $agentObj = new Agent;
        $agentObj->fname = $request->fname;
        $agentObj->lname = $request->lname;
        $agentObj->email = $request->email;
        $agentObj->city = $request->city;
        $agentObj->phone = $request->phone;
        $agentObj->address = $request->address;
        $agentObj->country = $request->country;
        $agentObj->opening_bal = $request->balance;
        $agentObj->balance = $request->balance;
        $agentObj->password =  Hash::make($request->password);
        
        if(isset($request->display_on_web)){
                $agentObj->display_on_web = 1;
            
        }

        if($request->file('picture')){
            
            $img_file = $request->file('picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/persons';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $agentObj->picture = $img_name;
                $agentObj->user_id = Auth::user()->id;
                $result = $agentObj->save();
               
                if($result){
                    return redirect('/agents-list')->with(['success'=>'Agent is Added Successfully']);
                }else{
                    return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
                }
                    
            }else{
                    return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
            }
        }
        // print_r($request->all());
    }
    public function AgentLedeger($id)
    {
        //
        $CashAgentdata = AgentLedeger::where('agent_id',$id)->paginate(500);
        // print_r($CashAgentdata);
        // die;
        return view('adminPanel.members.agentLedeger',compact('CashAgentdata'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('adminPanel.members.agentProfile');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $agentData = Agent::find($id);
        $countriesList = DB::table('country')->get();
        return view('adminPanel.members.agentUpdate',compact('agentData','countriesList'));
   
    }

    public function update_agent_status(Request $request){
        $status = '';
        if($request->agent_status == 'active'){
            $status = 'Block';
        }else{
            $status = 'active';
        }

        $agentData = Agent::find($request->agent_id)->update(['status'=>$status]);
         if($agentData){
            
            return redirect('agents-list')->with(['success'=>'Agent is Status Updated Successfully']);
        }else{
            return redirect('agents-list')->with(['error'=>'Something Went Wrong Try Again']);
        }
        // print_r($request->all());
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
        //
        // print_r($request->all());
        // die;
        $validated = $request->validate([
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'city' => 'required',
            'phone' => 'required',
            'address' => 'required',
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

                $result = Agent::find($id)->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'city' => $request->city,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'country' => $request->country,
                    'lname' => $request->lname,
                    'status' => $request->status,
                    'picture' => $img_name,
                    'display_on_web' => $request->display_on_web,
                ]);
            }
        }else{
            
            $result = Agent::find($id)->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'city' => $request->city,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country,
                'status' => $request->status,
                'display_on_web' => $request->display_on_web,
            ]);         
        }
        
        

        if($result){
            return redirect()->back()->with(['success'=>'Agent is updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function dashboard(){
        return view('adminPanel.members.agent_dashboard');
    }

    public function agent_login(){
        return view('adminPanel.members.agentLogin');
    }

    public function destroy($id)
    {
        //
    }
}
