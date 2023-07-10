<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clients\Client;
use App\Models\Clients\CurrenFollowUp;
use App\Models\Clients\FollowUpCategory;
use App\Models\Clients\FollowUpSubCategory;
use App\Models\Clients\ClientsFollowUp;
use App\Models\persons\Agent;

use Carbon\Carbon;
use Auth;
use DB;

class ClientController extends Controller
{
    //
    public function client_follow_up_sub(Request $request){
        // print_r($request->all());
        // die;
        try {
            DB::transaction(function() use($request){

                if(!empty($request->input('next_follow_up'))){
                    $nextFollowUp = $request->input('next_follow_up');
                    $carbonDate = Carbon::createFromFormat('Y-m-d\TH:i', $nextFollowUp);
    
                    // Assuming you have the user input for the time in the format HH:mm:ss
                    $timeInput = $request->input('next_follow_up');
                    $formattedDate = $carbonDate->subDay()->setTimeFromTimeString($timeInput)->format('Y-m-d H:i:s');
    
                }else{
                    $formattedDate =NULL;
                }
                
                $ClientsFollowUpObj = new ClientsFollowUp;
                $ClientsFollowUpObj->client_id = $request->client_id;
                $ClientsFollowUpObj->next_follow_up_time = $formattedDate;
                $ClientsFollowUpObj->sub_category_id = $request->follow_up_item;
                $ClientsFollowUpObj->follow_up_message = $request->reanson;
                $ClientsFollowUpObj->follow_up_by = Auth::user()->id;
                $ClientsFollowUpObj->save();

                $update_result = CurrenFollowUp::find($request->follow_up_id)->update([
                                        'status'=>'true'
                                    ]);
                
                if(isset($request->next_follow_up)){
                    $update_result = CurrenFollowUp::insert([
                        'client_id'=>$request->client_id,
                        'follow_up_time'=> $formattedDate
                    ]);
                }

                $client_data = Client::find($request->client_id);
                if($client_data->status == 'Open'){
                    // $update_result = Client::find($request->follow_up_id)->update([
                    //     'status'=>'In Progress'
                    // ]);
                    $client_data->status = 'In Progress';
                    $client_data->update();
                }


            });
            return redirect('/clients_list')->with(['success'=>'Client is Added Successfully']);

        } catch (\PDOException $e) {
            // Woopsy

            DB::rollBack();
            echo $e;
            die;
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }

    public function client_follow_up($id,$client_id){
        $allCategory = FollowUpCategory::all();
        $allSubCategory = FollowUpSubCategory::all();
        $follow_up_id = $id;
        return view('adminPanel.members.Clients.client_follow_up',compact('follow_up_id','client_id','allCategory','allSubCategory'));
    }

    public function clients_follow_up_list($id){
        $client_data = Client::find($id);
        $client_follow_up = ClientsFollowUp::where('client_id',$id)->orderBy('id','desc')->get();
        return view('adminPanel.members.Clients.client_follow_up_details',compact('client_data','client_follow_up'));
    }

    public function udpate_cleint_status(Request $req){
        $update_by = 'agent';
        if(isset($req->update_by)){
            $update_by = 'Admin';
        }

        Client::find($req->client_id)->update([
            'status'=>$req->client_status,
            'updated_by' =>$update_by,
            'update_by_id' => Auth::user()->id,
        ]);

        if(!isset($req->update_by)){
            return redirect('/clients_list')->with(['success'=>'Client is Added Successfully']);
        }else{
            return redirect('/all_clients_list')->with(['success'=>'Client is Added Successfully']);
        }
    }
    public function daily_dairy(){
        $today = Date('Y-m-d');
        $currentDateTime = Carbon::now();
        // Today Tasks
        // $lastFollowUpQuery = DB::table('clients_follow_ups')
        //                         ->select('client_id', DB::raw('MAX(id) as max_id'),'next_follow_up_time','sub_category_id','follow_up_message')
        //                         ->groupBy('client_id');
        // dd($lastFollowUpQuery);

        $today_follow_ups = CurrenFollowUp::join('clients','clients.id','curren_follow_ups.client_id')
                                ->whereDate('curren_follow_ups.follow_up_time', '=', $today)
                                ->where('clients.assign_to',Auth::user()->id)
                                ->select('clients.*','clients.id as client_id','curren_follow_ups.*')
                                ->get();

        // $today_follow_ups = CurrenFollowUp::join('clients','clients.id','curren_follow_ups.client_id')
        //                         ->joinSub($lastFollowUpQuery, 'last_follow_up', function ($join) {
        //                             $join->on('curren_follow_ups.client_id', '=', 'last_follow_up.client_id')
        //                                 ->on('curren_follow_ups.id', '=', 'last_follow_up.max_id');
        //                         })
        //                         ->whereDate('curren_follow_ups.follow_up_time', '=', $today)
        //                         ->select('clients.*','clients.id as client_id','curren_follow_ups.*','last_follow_up.*')
        //                         ->get();

        // dd($today_follow_ups);
        // Pending Tasks
        $pending_follow_ups = CurrenFollowUp::join('clients','clients.id','curren_follow_ups.client_id')
                                ->where('curren_follow_ups.follow_up_time', '<', $currentDateTime)
                                ->where('curren_follow_ups.status','false')
                                ->where('clients.status','!=','Mature')
                                ->where('clients.status','!=','Lost')
                                ->where('clients.assign_to',Auth::user()->id)
                                ->select('clients.*','clients.id as client_id','curren_follow_ups.*')
                                ->get();

        // dd($pending_follow_ups);
        // die;
        return view('adminPanel.members.Clients.daily_dairy',compact('today_follow_ups','pending_follow_ups'));
    }

    public function create(){
        $countriesList = DB::table('country')->get();
        return view('adminPanel.members.Clients.client_registration',compact('countriesList'));
    }

    public function clients_list(){
        $clients_list = Client::where('assign_to',Auth::user()->id)->orderBy('id','desc')->paginate(10);
        // dd($clients_list);
        return view('adminPanel.members.Clients.clients_list',compact('clients_list'));
    }

    public function all_clients_list(){
        $clients_list = Client::orderBy('id','desc')->paginate(10);

        $open_counts = Client::where('status','Open')->count();
        $in_progress_counts = Client::where('status','In Progress')->count();
        $mature_counts = Client::where('status','Mature')->count();
        $lost_counts = Client::where('status','Lost')->count();

        return view('adminPanel.Clients.clients_list',compact('clients_list',
        'open_counts','in_progress_counts','mature_counts','lost_counts'));
    }

    public function unassign_clients_list(){
        $clients_list = Client::orderBy('id','desc')->where('assign_to',NULL)->paginate(10);
        return view('adminPanel.Clients.unassign_clients_list',compact('clients_list'));
    }

    public function assign_clients_to_agents(){
        try {
            DB::transaction(function(){


                $clients_list = Client::orderBy('id','desc')->where('assign_to',NULL)->get();

                foreach($clients_list as $index => $client_res){
                    $unassigned_agent = Agent::where('client_assigns',0)->first();

                    if(!$unassigned_agent){
                        Agent::query()->update(['client_assigns' => 0]);
                        $unassigned_agent = Agent::where('client_assigns',0)->first();
                    }

                    if(isset($unassigned_agent)){

                        Client::find($client_res->id)->update([
                            'assign_to' => $unassigned_agent->id
                        ]);

                        Agent::find($unassigned_agent->id)
                                ->update(['client_assigns'=> 1]);

                        $currentDateTime = Carbon::now();
                        $dateTimeAfterOneHour = $currentDateTime->addHour();
    
                        $formattedDateTime = $dateTimeAfterOneHour->format('Y-m-d H:i:s');
    
                        $followUp_result = CurrenFollowUp::insert([
                            'client_id'=> $client_res->id,
                            'follow_up_time'=> $formattedDateTime,
                        ]);
                    }
                }
         });
            return redirect('/all_clients_list')->with(['success'=>'Client is Assigned Successfully']);

        } catch (\PDOException $e) {
            // Woopsy

            DB::rollBack();
            // echo $e;
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }


    public function clients_follow_up_list_admin($id){
        $client_data = Client::find($id);
        $client_follow_up = ClientsFollowUp::where('client_id',$id)->orderBy('id','desc')->get();
        return view('adminPanel.Clients.client_follow_up_details',compact('client_data','client_follow_up'));
    }
    

    public function store(Request $request){
        $validated = $request->validate([
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'city' => 'required',
            'phone' => 'required',
        ]);

        try {
            DB::transaction(function() use($request){
                   $Cleint_Obj = new Client;
                   $Cleint_Obj->first_name =  $request->fname;
                   $Cleint_Obj->last_name =  $request->lname;
                   $Cleint_Obj->city =  $request->city;
                   $Cleint_Obj->country =  $request->country;
                   $Cleint_Obj->phone =  $request->phone;
                   $Cleint_Obj->dealer_name =  $request->dealer_name;
                   $Cleint_Obj->client_profession =  $request->client_profession;
                   $Cleint_Obj->client_address =  $request->client_address;
                   $Cleint_Obj->other_phone =  $request->other_phone;
                   $Cleint_Obj->email =  $request->email;
                   $Cleint_Obj->client_type =  $request->client_type;
                   $Cleint_Obj->client_resource =  $request->client_resource;
                   $Cleint_Obj->assign_to =  Auth::user()->id;
                   $Cleint_Obj->created_by =  Auth::user()->id;

                   $result = $Cleint_Obj->save();
                    
                //    dd($Cleint_Obj);
                    $client_id = $Cleint_Obj->id;
                    $client_id = (int)$client_id;
                    // print_r($client_id);
                    // die;
                    $currentDateTime = Carbon::now();
                    $dateTimeAfterOneHour = $currentDateTime->addHour();

                    $formattedDateTime = $dateTimeAfterOneHour->format('Y-m-d H:i:s');

                    $followUp_result = CurrenFollowUp::insert([
                        'client_id'=> $client_id,
                        'follow_up_time'=> $formattedDateTime,
                    ]);

            });
            return redirect('/clients_list')->with(['success'=>'Client is Added Successfully']);

        } catch (\PDOException $e) {
            // Woopsy

            DB::rollBack();
            // echo $e;
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }

    }

    public function add_client_admin(){
        $countriesList = DB::table('country')->get();
        return view('adminPanel.Clients.client_registration',compact('countriesList'));
    }

    public function store_admin(Request $request){
        $validated = $request->validate([
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'city' => 'required',
            'phone' => 'required',
        ]);

        try {
            DB::transaction(function() use($request){
                   $Cleint_Obj = new Client;
                   $Cleint_Obj->first_name =  $request->fname;
                   $Cleint_Obj->last_name =  $request->lname;
                   $Cleint_Obj->city =  $request->city;
                   $Cleint_Obj->country =  $request->country;
                   $Cleint_Obj->phone =  $request->phone;
                   $Cleint_Obj->dealer_name =  $request->dealer_name;
                   $Cleint_Obj->client_profession =  $request->client_profession;
                   $Cleint_Obj->client_address =  $request->client_address;
                   $Cleint_Obj->other_phone =  $request->other_phone;
                   $Cleint_Obj->email =  $request->email;
                   $Cleint_Obj->client_type =  $request->client_type;
                   $Cleint_Obj->client_resource =  $request->client_resource;
                   $Cleint_Obj->created_by =  Auth::user()->id;

                   $result = $Cleint_Obj->save();

            });
            return redirect('/all_clients_list')->with(['success'=>'Client is Added Successfully']);

        } catch (\PDOException $e) {
            // Woopsy

            DB::rollBack();
            // echo $e;
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }

    }
    
    
}
