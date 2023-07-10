<?php

namespace App\Http\Controllers\location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\locations\Marala;
use App\Models\locations\Files;
use App\Models\locations\Blocks;
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
use Auth;
use DB;



class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Customers_data = Customers::all();
        $Agent_data = Agent::all();
        $CashAccounts_data = CashAccounts::all();
        $Location_data = Location::all();
        $files_data = Files::orderBy("id","desc")->paginate(50);
        return view('adminPanel.locations.filesList',compact('files_data','Customers_data','Agent_data','CashAccounts_data','Location_data'));
    }

    public function file_print($id){
        $files_data = Files::find($id);
        return view('adminPanel.locations.filesPrint',compact('files_data'));
    }

    public function files_reports(){
        $Location_data = Location::all();
        $CashAccounts_data = CashAccounts::all();
        $marala = Marala::all();
        return view('adminPanel.locations.filesReports',compact('Location_data','CashAccounts_data','marala'));
    }

    public function status_wise_files(Request $request){
        if($request->status != 1){
            $files_data = Files::where("status",$request->status)->get();
        }else{
            $files_data = Files::all();
        }
        
        $status = $request->status;
        return view('adminPanel.locations.statusWiseFile',compact('files_data','status'));
        
    }

    public function marala_wise_files(Request $request){
        $marala_data = json_decode($request->marala);
        if($request->status != 1){
            $files_data = Files::where('marala_type',$marala_data->id)
                                 ->where("status",$request->status)->get();
        }else{
            $files_data = Files::where('marala_type',$marala_data->id)->get();
        }
        
        $status = $request->status;
        $marala = $marala_data->marala;
        return view('adminPanel.locations.maralWiseFile',compact('files_data','status','marala'));
        
    }

    public function purchase_status_wise_files(Request $request){
        if($request->status != 1){
            $files_data = Files::whereBetween('purchase_date',[$request->start_date,$request->end_date])
                                 ->where("status",$request->status)->get();
        }else{
            $files_data = Files::whereBetween('purchase_date',[$request->start_date,$request->end_date])->get();
        }
        
        $status = $request->status;
        $start = $request->start_date;
        $end = $request->end_date;
        return view('adminPanel.locations.purchaseStatusWiseFiles',compact('files_data','status','start','end'));
        
    }

    public function sale_status_wise_files(Request $request){
        if($request->status != 1){
            $files_data = Files::whereBetween('sold_date',[$request->start_date,$request->end_date])
                                 ->where("status",$request->status)->get();
        }else{
            $files_data = Files::whereBetween('sold_date',[$request->start_date,$request->end_date])->get();
        }
        
        $status = $request->status;
        $start = $request->start_date;
        $end = $request->end_date;
        return view('adminPanel.locations.saleStatusWiseFiles',compact('files_data','status','start','end'));
        
    }

    

    

    public function location_wise_files(Request $request){
        if($request->status != 1){
            $files_data = Files::where('location_id',$request->location)
            ->where("status",$request->status)->get();
        }else{
            $files_data = Files::where('location_id',$request->location)->get();
        }
        
        $status = $request->status;
        $location = $request->location;
        return view('adminPanel.locations.locationWiseFile',compact('files_data','status','location'));
        
    }

    public function societies_wise_files(Request $request){
        if($request->status != 1){
            $files_data = Files::where('society_id',$request->society_id)
            ->where("status",$request->status)->get();
        }else{
            $files_data = Files::where('society_id',$request->society_id)->get();
        }
        
        $status = $request->status;
        $society_id = $request->society_id;
        return view('adminPanel.locations.societiesWiseFile',compact('files_data','status','society_id'));
        
    }

    public function societies_block_wise_files(Request $request){
        if($request->status != 1){
            $files_data = Files::where('society_id',$request->society_id)
            ->where('block_id',$request->block_id)
            ->where("status",$request->status)->get();
        }else{
            $files_data = Files::where('society_id',$request->society_id)
            ->where('block_id',$request->block_id)
            ->get();
        }
        
        $status = $request->status;
        $society_id = $request->society_id;
        return view('adminPanel.locations.societiesBlockWiseFile',compact('files_data','status','society_id'));
        
    }

    

    // 
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
        return view('adminPanel.locations.addFile',compact('Location_data','CashAccounts_data'));
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
        //
        $validated = $request->validate([
            'registration_no' => 'required',
            'location_id'=>'required',
            'society_id'=>'required',
            'block_id'=>'required',
            'purchase_amount'=>'required',
            'purchase_date'=>'required',
            'marala_type'=>'required',
            'description' => 'max:4294967295',
        ]);

        $fileObj = new Files;
        $fileObj->registration_no = $request->registration_no;
        $fileObj->location_id = $request->location_id;
        $fileObj->society_id = $request->society_id;
        $fileObj->block_id = $request->block_id;
        $fileObj->purchase_amount = $request->purchase_amount;
        $fileObj->purchase_date = $request->purchase_date;
        $fileObj->marala_type = $request->marala_type;
        $fileObj->state_type = $request->state_type;
        $fileObj->account_id = $request->account_id;
        $fileObj->description = $request->description;
        $result = $fileObj->save();
        if($result){
            return redirect('/files-list')->with(['success'=>'File is Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }

    public function update_file_purchase(Request $request)
    {
        // print_r($request->all());
        // die;
        $validated = $request->validate([
            'registration_no' => 'required',
            'location_id'=>'required',
            'society_id'=>'required',
            'block_id'=>'required',
            'purchase_amount'=>'required',
            'purchase_date'=>'required',
            'marala_type'=>'required',
            'description' => 'max:4294967295',
        ]);

        // die;

        $fileObj =  Files::find($request->file_id);
        $fileObj->registration_no = $request->registration_no;
        $fileObj->location_id = $request->location_id;
        $fileObj->society_id = $request->society_id;
        $fileObj->block_id = $request->block_id;
        $fileObj->purchase_amount = $request->purchase_amount;
        $fileObj->purchase_date = $request->purchase_date;
        $fileObj->marala_type = $request->marala_type;
        $fileObj->state_type = $request->state_type;
        $fileObj->account_id = $request->account_id_update;
        $fileObj->description = $request->description;
        $result = $fileObj->update();
        if($result){
            return redirect('/files-list')->with(['success'=>'File is Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }

    

    public function files_sale(Request $request)
    {
        // print_r($request->all());
        //
        $validated = $request->validate([
            'sold_date' => 'required',
            'customer_id'=>'required',
            'sale_amount'=>'required',
            'commission_amount'=>'required',
            'recevied_amount'=>'required',
            'remaining_amount'=>'required',
            'agent_id'=>'required',
            'account_id_recv'=>'required',
        ]);

        $fileObj = Files::find($request->file_id);
        $fileObj->sold_date = $request->sold_date;
        $fileObj->customer_id = $request->customer_id;
        $fileObj->sale_amount = $request->sale_amount;
        $fileObj->recevied_amount = $request->recevied_amount;
        $fileObj->remaining_amount = $request->remaining_amount;
        $fileObj->commission_amount = $request->commission_amount;
        $fileObj->agent_id = $request->agent_id;
        $fileObj->account_id_recv = $request->account_id_recv;
        $fileObj->status = 'pending sale';
        $result = $fileObj->update();
        if($result){
            return redirect('/files-list')->with(['success'=>'File is Sale Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }

    public function update_file_sale(Request $request)
    {
        // print_r($request->all());
        
        $validated = $request->validate([
            'sold_date_sale' => 'required',
            'customer_id'=>'required',
            'sale_amount'=>'required',
            'commission_amount'=>'required',
            'recevied_amount'=>'required',
            'remaining_amount'=>'required',
            'agent_id'=>'required',
            'account_id_recv'=>'required',
        ]);

        $fileObj = Files::find($request->file_id);
        $fileObj->sold_date = $request->sold_date_sale;
        $fileObj->customer_id = $request->customer_id;
        $fileObj->sale_amount = $request->sale_amount;
        $fileObj->recevied_amount = $request->recevied_amount;
        $fileObj->remaining_amount = $request->remaining_amount;
        $fileObj->commission_amount = $request->commission_amount;
        $fileObj->agent_id = $request->agent_id;
        $fileObj->account_id_recv = $request->account_id_recv;
        // $fileObj->status = 'pending sale';
        $result = $fileObj->update();
        if($result){
            return redirect('/files-list')->with(['success'=>'File is Sale Successfully']);
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

    public function fetch_file_wi_id(Request $request){
        // print_r($request->all());
        $files_data = Files::find($request->file_id);

        $location_name = $files_data->fileslocation->location_name;
        $society_name = $files_data->filesSociety->society_name;
        $block_name = $files_data->filesBlock->block_name;
        $marala = $files_data->filesMaral->marala;
        return [$files_data,
                'location_name'=>$location_name,
                'society_name'=>$society_name,
                'block_name'=>$block_name,
                'marala'=>$marala,
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

    public function fetch_blocks_wi_scotites(Request $request)
    {
        $socities_blocks = Blocks::where('scoiety',$request->scoitiy_id)
        ->select('id','block_name')
        ->get();
        
        return $socities_blocks;
        // print_r($location_socities);
        // echo "Socitites Function is call now ";
    }

    public function post_file_purchase(Request $request){
        // print_r($request->all());

        // Update Account Balance 
        $fileData = Files::find($request->file_id);

        if($fileData->status != 'Purchase'){
            $fileData->purc_post_status = true;
            $fileData->status = 'Purchase';

            $accountBal = CashAccountsBal::where('account_id',$request->account_id)->first();
            $updatedBalance = $accountBal->balance - $fileData->purchase_amount;
            $accountBal->balance = $updatedBalance;
        
            $CashAccledgerObj = new CashAccountledger;
            $CashAccledgerObj->payment = $fileData->purchase_amount;
            $CashAccledgerObj->account_id = $request->account_id;
            $CashAccledgerObj->balance = $updatedBalance;
            $CashAccledgerObj->user_id = Auth::user()->id;

            try {
                DB::transaction(function() use ($fileData, $CashAccledgerObj,$accountBal) {
                    $fileData->update();
                    $CashAccledgerObj->file_id = $fileData->id;
                    $accountBal->update();
                    $CashAccledgerObj->save();
                });
                return redirect('/files-list')->with(['success'=>'File Posted Successfully']);
            } catch (\PDOException $e) {
                // Woopsy
                echo $e;
                DB::rollBack();
                return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
            }
         }else{
            return redirect()->back()->with(['error'=>'File is Already Purchase']);
         }
    }

    public function post_file_sale(Request $request){
        // print_r($request->all());

        // Update Account Balance 
        $fileData = Files::find($request->file_id);

        if($fileData->status != 'sale'){
            $fileData->sale_post_status = true;

            // print_r($fileData);
            // die;
            $fileData->status = 'sale';

            // Update Account Balance
            $accountBal = CashAccountsBal::where('account_id',$fileData->account_id_recv)->first();
            $updatedBalance = $accountBal->balance + $fileData->recevied_amount;
            $accountBal->balance = $updatedBalance;
        
            // Update Custoemr Balance 
            $CustomerBal = CustomerBalance::where('customer_id',$fileData->customer_id)->first();
            $custUpdatedBalance = $CustomerBal->balance + ($fileData->sale_amount - $fileData->recevied_amount);
            $CustomerBal->balance = $custUpdatedBalance;

            $AgentBal = AgentBalance::where('agent_id',$fileData->agent_id)->first();
            $updatedBalanceAgent = $AgentBal->balance + $fileData->commission_amount;
            $AgentBal->balance = $updatedBalanceAgent;
            

            // Insert Account Ledeger 
            $AgentledgerObj = new AgentLedeger;
            // Insert Customer Ledeger 
            $AgentledgerObj->commission = $fileData->commission_amount;
            $AgentledgerObj->agent_id = $fileData->agent_id;
            $AgentledgerObj->balance = $updatedBalanceAgent;
            $AgentledgerObj->file_id = $fileData->id;
            $AgentledgerObj->user_id = Auth::user()->id;
            

            
            // Insert Account Ledeger 
            $CashAccledgerObj = new CashAccountledger;
            $CashAccledgerObj->received = $fileData->recevied_amount;
            $CashAccledgerObj->account_id = $fileData->account_id_recv;
            $CashAccledgerObj->balance = $updatedBalance;
            $CashAccledgerObj->user_id = Auth::user()->id;

            // Insert Customer Ledeger 
            $CustomerledgerObj = new Customerledger;
            $CustomerledgerObj->payment = $fileData->recevied_amount;
            $CustomerledgerObj->customer_id = $fileData->customer_id;
            $CustomerledgerObj->balance = $custUpdatedBalance;
            $CustomerledgerObj->user_id = Auth::user()->id;

            try {
                DB::transaction(function() use ($AgentBal,$AgentledgerObj,$fileData, $CashAccledgerObj,$accountBal,$CustomerBal,$CustomerledgerObj) {
                    $fileData->update();
                    $CashAccledgerObj->file_id = $fileData->id;
                    $CustomerledgerObj->file_id = $fileData->id;
                    $accountBal->update();
                    $CustomerBal->update();
                    $CashAccledgerObj->save();
                    $CustomerledgerObj->save();
                    $AgentBal->save();
                    $AgentledgerObj->save();
                });
                return redirect('/files-list')->with(['success'=>'File Posted Successfully']);
            } catch (\PDOException $e) {
                // Woopsy
                echo $e;
                DB::rollBack();
                return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
            }
        }else{
            return redirect()->back()->with(['error'=>'File is Already Sale']);
        }
    }

    
    

    
}
