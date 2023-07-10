<?php

namespace App\Http\Controllers\location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Location;
use App\Models\locations\Marala;
use App\Models\locations\LocalProperty;
use App\Models\locations\Societies;
use App\Models\persons\Customers;
use App\Models\persons\CustomerBalance;
use App\Models\persons\Customerledger;
use App\Models\persons\Agent;
use App\Models\persons\AgentBalance;
use App\Models\persons\AgentLedeger;
use App\Models\Accounts\CashAccounts;
use App\Models\Accounts\CashAccountsBal;
use App\Models\Accounts\CashAccountledger;
use App\Models\persons\Buyers;

use Auth;
use DB;

class LocalPropertyController extends Controller
{
    //
    public function index()
    {
        //
        $Customers_data = Customers::all();
        $Agent_data = Agent::all();
        $Buyers = Buyers::all();
        $CashAccounts_data = CashAccounts::all();
        $property_data = LocalProperty::orderBy("id","desc")->paginate(10);
        // print_r($property_data);
        // die;
        return view('adminPanel.locations.propertyList',compact('property_data','Customers_data','Agent_data','CashAccounts_data','Buyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Location_data = Location::all();
        $CashAccounts_data = CashAccounts::all();
        $Agent_data = Agent::all();
        $Customers_data = Customers::all();

        
        return view('adminPanel.locations.addProperty',compact('Location_data','CashAccounts_data','Agent_data','Customers_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->all());
        // die;
        //
        $validated = $request->validate([
            'title'=>'required',
            'demand_amount' => 'required',
            'location_id'=>'required',
            'society_id'=>'required',
            'owner_name'=>'required',
            'customer_id'=>'required',
            'demand_amount'=>'required',
            'agent_id'=>'required',
            'description' => 'max:4294967295',
        ]);

        $propertyObj = new LocalProperty;

        if($request->property_type == 'Commerical'){
            $propertyObj->property_type = $request->property_type_comm;
        }else{
            $propertyObj->property_type = $request->property_type_resid;
        }
        $propertyObj->location_id = $request->location_id;
        $propertyObj->title = $request->title;
        
        $propertyObj->society_id = $request->society_id;
        $propertyObj->state_type = $request->property_type;
        $propertyObj->marala_type = $request->marala_type;
        $propertyObj->area = $request->area;
        $propertyObj->road_size = $request->road_size;
        $propertyObj->street_size = $request->street_size;
        $propertyObj->demand_amount = $request->demand_amount;
        $propertyObj->taken_amount = $request->taken_amount;
        $propertyObj->owner_name = $request->owner_name;
        $propertyObj->owner_phone_no = $request->owner_phone;
        $propertyObj->customer_id = $request->customer_id;
        $propertyObj->agent_id = $request->agent_id;        
        $propertyObj->description = $request->description;
        $propertyObj->user_id = Auth::user()->id;


        if($request->file('img')){
                 
            $img_file = $request->file('img');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/Societies';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $propertyObj->img = $img_name;
            }else{
                $propertyObj->img = '';
            }
        }else{
            $propertyObj->img = '';
        }

        $result = $propertyObj->save();
        if($result){
            return redirect('/property-list')->with(['success'=>'Property is Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }


        
    }

    public function property_sale(Request $request)
    {
        // print_r($request->all());
        //


        $propertyObj = LocalProperty::find($request->property_id);
        $propertyObj->sold_date = $request->sold_date;
        $propertyObj->buyer_id = $request->buyer_id;
        $propertyObj->sale_amount = $request->sale_amount;
        $propertyObj->commission_amount = $request->commission_amount;
        $propertyObj->agent_commission = $request->agent_commission;
        $propertyObj->commission_paid = $request->commission_paid;
        $propertyObj->account_id_recv = $request->account_id_recv;
       
        $propertyObj->status = 'Pending sale';
        $result = $propertyObj->update();
        if($result){
            return redirect('/property-list')->with(['success'=>'Property is Sale Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
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
    }

    public function fetch_proporty_wi_id(Request $request){
        // print_r($request->all());
        $property_data = LocalProperty::find($request->property_id);

        $location_name = $property_data->Propertylocation->location_name;
        $society_name = $property_data->PropertySociety->society_name;
        $marala = $property_data->PropertyMaral->marala;
        $customer_name = $property_data->PropertyCustomer->custfname." ".$property_data->PropertyCustomer->custlname;
        $agent_name = $property_data->PropertyAgent->fname." ".$property_data->PropertyAgent->lname;
        return [$property_data,
                'location_name'=>$location_name,
                'society_name'=>$society_name,
                'marala'=>$marala,
                'customer_name'=>$customer_name,
                'agent_name'=>$agent_name,
                ];
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
        $property_data = LocalProperty::find($id);
        $Location_data = Location::all();
        $CashAccounts_data = CashAccounts::all();
        $Agent_data = Agent::all();
        $Customers_data = Customers::all();

        
        return view('adminPanel.locations.property_update',compact('Location_data','CashAccounts_data','Agent_data','Customers_data','property_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validated = $request->validate([
            'title'=>'required',
            'demand_amount' => 'required',
            'location_id'=>'required',
            'society_id'=>'required',
            'owner_name'=>'required',
            'customer_id'=>'required',
            'demand_amount'=>'required',
            'agent_id'=>'required',
            'description' => 'max:4294967295',
        ]);

        $propertyObj = LocalProperty::find($request->id);

        if($request->property_type == 'Commerical'){
            $propertyObj->property_type = $request->property_type_comm;
        }else{
            $propertyObj->property_type = $request->property_type_resid;
        }
        $propertyObj->location_id = $request->location_id;
        $propertyObj->title = $request->title;
        
        $propertyObj->society_id = $request->society_id;
        $propertyObj->state_type = $request->property_type;
        $propertyObj->marala_type = $request->marala_type;
        $propertyObj->area = $request->area;
        $propertyObj->road_size = $request->road_size;
        $propertyObj->street_size = $request->street_size;
        $propertyObj->demand_amount = $request->demand_amount;
        $propertyObj->taken_amount = $request->taken_amount;
        $propertyObj->owner_name = $request->owner_name;
        $propertyObj->owner_phone_no = $request->owner_phone;
        $propertyObj->customer_id = $request->customer_id;
        $propertyObj->agent_id = $request->agent_id;        
        $propertyObj->description = $request->description;


        if($request->file('img')){
                 
            $img_file = $request->file('img');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/Societies';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $propertyObj->img = $img_name;
            }
        }

        $result = $propertyObj->update();
        if($result){
            return redirect('/property-list')->with(['success'=>'Property is Updated Successfully']);
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
    public function destroy($id)
    {
        //
    }

    public function add_marala_type(Request $request)
    {
        $maralaObj = new Marala;
        $maralaObj->marala = $request->marala;
        $result = $maralaObj->save();

        if($result){
            return true;
        }

        return false;
        // print_r($request->all());
    }

    public function fetch_marala_type(Request $request)
    {
        $maralas =  Marala::all();
        return $maralas;
        // print_r($request->all());
    }

    public function fetch_socities_wi_location(Request $request)
    {
        $location_socities = Societies::where('location',$request->location_id)
        ->select('id','society_name')
        ->get();
        
        return $location_socities;
        // print_r($location_socities);
        // echo "Socitites Function is call now ";
    }

    public function localproperty_print($id){
        $property_data = LocalProperty::find($id);
        // print_r($property_data);
        return view('adminPanel.locations.localPropertyPrint',compact('property_data'));
    }

    public function fetch_blocks_wi_scotites(Request $request)
    {
        $socities_blocks = Blocks::where('scoiety',$request->scoitiy_id)
        ->select('id','block_name')
        ->get();
        
        return $socities_blocks;
        // print_r($location_socities);
        // echo "Socitites Function is call now ";
    }



    public function post_property_sale(Request $request){
   
        // Update Account Balance 
        $propertyData = LocalProperty::find($request->property_id);

        if($propertyData->status != 'sale'){
            $propertyData->sale_post_status = true;
            $propertyData->status = 'sale';


            // Update Account Balance
            $accountBal = CashAccountsBal::where('account_id',$propertyData->account_id_recv)->first();
            $updatedBalance = $accountBal->balance + $propertyData->commission_amount;
            $accountBal->balance = $updatedBalance;

            $AgentBal = AgentBalance::where('agent_id',$propertyData->agent_id)->first();
            $updatedBalanceAgent = $AgentBal->balance + $propertyData->agent_commission;
            $AgentBal->balance = $updatedBalanceAgent;
            

            // Insert Account Ledeger 
            $AgentledgerObj = new AgentLedeger;
            // Insert Customer Ledeger 
            $AgentledgerObj->commission = $propertyData->agent_commission;
            $AgentledgerObj->agent_id = $propertyData->agent_id;
            $AgentledgerObj->balance = $updatedBalanceAgent;
            $AgentledgerObj->file_id = $propertyData->id;
            $AgentledgerObj->user_id = Auth::user()->id;
            
            // Insert Account Ledeger 
            $CashAccledgerObj = new CashAccountledger;
            $CashAccledgerObj->received = $propertyData->commission_amount;
            $CashAccledgerObj->account_id = $propertyData->account_id_recv;
            $CashAccledgerObj->balance = $updatedBalance;
            $CashAccledgerObj->user_id = Auth::user()->id;

            try {
                DB::transaction(function() use ($AgentBal,$AgentledgerObj,$propertyData, $CashAccledgerObj,$accountBal) {
                    $propertyData->update();
                    $CashAccledgerObj->property_id = $propertyData->id;
                    $accountBal->update();
                    $CashAccledgerObj->save();
                    $AgentBal->save();
                    $AgentledgerObj->save();
                });
                return redirect('/property-list')->with(['success'=>'Property Posted Successfully']);
            } catch (\PDOException $e) {
                // Woopsy
                echo $e;
                DB::rollBack();
                return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
            }
        }else{
            return redirect()->back()->with(['error'=>'Local Property is alreay Sale']);
        }
    }

    public function local_porperty_reports(){
        $Location_data = Location::all();
        $CashAccounts_data = CashAccounts::all();
        $marala = Marala::all();
        return view('adminPanel.locations.localPropertyReports',compact('Location_data','CashAccounts_data','marala'));
    }

    public function status_wise_property(Request $request){
        if($request->status == 1 && $request->property_type == 1 && $request->property_type_comm == 1){
            $LocalProperty_data = LocalProperty::whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])->get();
        }

        if($request->status != 1 && $request->property_type == 1 && $request->property_type_comm == 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            // ->where('state_type',$request->property_type)                        
            // ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status != 1 && $request->property_type != 1 && $request->property_type_comm == 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->where('state_type',$request->property_type)  
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])                      
            // ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status != 1 && $request->property_type == 1 && $request->property_type_comm!= 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            // ->where('state_type',$request->property_type)                        
            ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status != 1 && $request->property_type != 1 && $request->property_type_comm != 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            ->where('state_type',$request->property_type)                        
            ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status == 1 && $request->property_type != 1 && $request->property_type_comm != 1){
            $LocalProperty_data = LocalProperty::
                where('state_type',$request->property_type)  
                ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])                      
            ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status == 1 && $request->property_type == 1 && $request->property_type_comm != 1){
            $LocalProperty_data = LocalProperty::                    
            where('property_type',$request->property_type_comm)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])                        
            ->get();
        }
        
        
        
        $status = $request->status;
        $request_data = $request->all();
        // print_r($request_data);
        // die;
        return view('adminPanel.locations.statusWiseProperty',compact('LocalProperty_data','status','request_data'));
        
    }

    public function location_wise_property(Request $request){
        if($request->status == 1 && $request->property_type == 1 && $request->property_type_comm == 1){
            $LocalProperty_data = LocalProperty::whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            ->where('location_id',$request->location)
            ->get();
        }

        if($request->status != 1 && $request->property_type == 1 && $request->property_type_comm == 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            ->where('location_id',$request->location)
            // ->where('state_type',$request->property_type)                        
            // ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status != 1 && $request->property_type != 1 && $request->property_type_comm == 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->where('state_type',$request->property_type)  
            ->where('location_id',$request->location)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])                      
            // ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status != 1 && $request->property_type == 1 && $request->property_type_comm!= 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            // ->where('state_type',$request->property_type)                        
            ->where('location_id',$request->location)
            ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status != 1 && $request->property_type != 1 && $request->property_type_comm != 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            ->where('state_type',$request->property_type)                        
            ->where('property_type',$request->property_type_comm) 
            ->where('location_id',$request->location)                       
            ->get();
        }

        if($request->status == 1 && $request->property_type != 1 && $request->property_type_comm != 1){
            $LocalProperty_data = LocalProperty::
                where('state_type',$request->property_type)  
                ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])                      
            ->where('property_type',$request->property_type_comm) 
            ->where('location_id',$request->location)                       
            ->get();
        }

        if($request->status == 1 && $request->property_type == 1 && $request->property_type_comm != 1){
            $LocalProperty_data = LocalProperty::                    
            where('property_type',$request->property_type_comm)
            ->where('location_id',$request->location)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])                        
            ->get();
        }
        
        
        
        $status = $request->status;
        $request_data = $request->all();
        $location_data = Location::find($request->location);
        // print_r($request_data);
        // die;
        return view('adminPanel.locations.locationWiseProperty',compact('LocalProperty_data','status','request_data','location_data'));
        
    }

    public function societies_wise_property(Request $request){
        if($request->status == 1 && $request->property_type == 1 && $request->property_type_comm == 1){
            $LocalProperty_data = LocalProperty::whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            ->where('society_id',$request->society_id)
            ->get();
        }

        if($request->status != 1 && $request->property_type == 1 && $request->property_type_comm == 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            ->where('society_id',$request->society_id)
            // ->where('state_type',$request->property_type)                        
            // ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status != 1 && $request->property_type != 1 && $request->property_type_comm == 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->where('state_type',$request->property_type)  
            ->where('society_id',$request->society_id)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])                      
            // ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status != 1 && $request->property_type == 1 && $request->property_type_comm!= 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            // ->where('state_type',$request->property_type)                        
            ->where('society_id',$request->society_id)
            ->where('property_type',$request->property_type_comm)                        
            ->get();
        }

        if($request->status != 1 && $request->property_type != 1 && $request->property_type_comm != 1){
            $LocalProperty_data = LocalProperty::where("status",$request->status)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])
            ->where('state_type',$request->property_type)                        
            ->where('property_type',$request->property_type_comm) 
            ->where('society_id',$request->society_id)                       
            ->get();
        }

        if($request->status == 1 && $request->property_type != 1 && $request->property_type_comm != 1){
            $LocalProperty_data = LocalProperty::
                where('state_type',$request->property_type)  
                ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])                      
            ->where('property_type',$request->property_type_comm) 
            ->where('society_id',$request->society_id)                       
            ->get();
        }

        if($request->status == 1 && $request->property_type == 1 && $request->property_type_comm != 1){
            $LocalProperty_data = LocalProperty::                    
            where('property_type',$request->property_type_comm)
            ->where('society_id',$request->society_id)
            ->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date])                        
            ->get();
        }
        
        
        
        $status = $request->status;
        $request_data = $request->all();
        $society_data = Societies::find($request->society_id);
        // print_r($request_data);
        // die;
        return view('adminPanel.locations.societyWiseProperties',compact('LocalProperty_data','status','request_data','society_data'));
        
    }

    public function marala_wise_property(Request $request){
        $marala_data = json_decode($request->marala);
        if($request->status != 1){
            $LocalProperty_data = LocalProperty::where('marala_type',$marala_data->id)
                                 ->where("status",$request->status)->get();
        }else{
            $LocalProperty_data = LocalProperty::where('marala_type',$marala_data->id)->get();
        }
        
        $status = $request->status;
        $marala = $marala_data->marala;
        return view('adminPanel.locations.maralWiseLocalProperty',compact('LocalProperty_data','status','marala'));
        
    }

    

    
    
    
    

    
}
