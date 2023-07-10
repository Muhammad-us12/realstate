<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\CashAccounts;
use App\Models\Accounts\Payments;

use App\Models\persons\CustomerBalance;
use App\Models\persons\Customerledger;
use App\Models\persons\AgentBalance;
use App\Models\persons\AgentLedeger;
use App\Models\Accounts\CashAccountsBal;
use App\Models\Accounts\CashAccountledger;
use Auth;
use DB;
use Session;
use Helper;
use Illuminate\Support\Facades\Log;


class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments_list = Payments::orderBy("id",'desc')->select('id','date','payment_from','total_payments')->paginate(50);
        return view('adminPanel.accounts.paymentList',compact('payments_list'));
        // print_r($payments_list);
    }

    function payment_list_print($id){
        $payment_data = Payments::find($id);
        // print_r($payment_data);
        // die;
        return view('adminPanel.accounts.payment_list_print',compact('payment_data'));
    }

    public function payments_reports(){
        $CashAccountsdata = CashAccounts::all();
        return view('adminPanel.accounts.payments_reports',compact('CashAccountsdata'));
    }

    public function date_wise_payment(Request $request){
        $payments_data = DB::table('payments')
                            ->join('cash_accounts', 'cash_accounts.id', '=', 'payments.payment_from')// joining the contacts table , where user_id and contact_user_id are same
                            ->whereBetween('date', [$request->start_date,$request->end_date])
                            ->select('payments.id','payments.total_payments','payments.date','payments.payment_from','cash_accounts.account_name','cash_accounts.account_number')
                            ->get();
        // print_r($payments_data);
        // die;
        return view('adminPanel.accounts.date_wise_payments',compact('payments_data','request'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // session()->forget('form_submit');

        // $session_data = session('_token');
        // log::info('session found create'.$session_data);
        
        $CashAccountsdata = CashAccounts::all();
        return view('adminPanel.accounts.paymentAdd',compact('CashAccountsdata'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // $session_Get = session()->get('last');
        // echo $session_Get;
        // die;
        $session_Get = Session::get('last');
        
        $result_found = Helper::prevent_multi_submit($request->all());

        if($result_found){


            DB::beginTransaction();
            try {
                // Insert Payment in Table 
                $paymentObj = new Payments;
                $paymentObj->date = $request->current_date;
                $paymentObj->prev_balance = $request->account_prev_bal;
                $paymentObj->updated_balance = $request->updated_balnc;
                $paymentObj->total_payments = $request->total_payments;
                $paymentObj->Criteria = json_encode($request->criteria);
                $paymentObj->Content = json_encode($request->content);
                $paymentObj->Content_Ids = json_encode($request->content_ids);
                $paymentObj->Amount = json_encode($request->amount);
                $paymentObj->remarks = json_encode($request->remarks);
                $paymentObj->payment_from = $request->payment_from;
                $paymentObj->user_id = Auth::user()->id;
                $paymentObj->save();

                foreach($request->criteria as $index => $ctr_res){
                    if($ctr_res == 'Agent'){
                        
                        $AgentBal = AgentBalance::where('agent_id',$request->content_ids[$index])->first();
                        $updatedBalance = $AgentBal->balance - $request->amount[$index];
                        $AgentBal->balance = $updatedBalance;
                        $AgentBal->save();

                        // Insert Account Ledeger 
                        $AgentledgerObj = new AgentLedeger;
                        // Insert Customer Ledeger 
                        $AgentledgerObj->received = $request->amount[$index];
                        $AgentledgerObj->agent_id = $request->content_ids[$index];
                        $AgentledgerObj->balance = $updatedBalance;
                        $AgentledgerObj->payment_id = $paymentObj->id;
                        $AgentledgerObj->user_id = Auth::user()->id;
                        $AgentledgerObj->save();
                    }

                    if($ctr_res == 'Account'){
                        // Update Account Balance
                        $accountBal = CashAccountsBal::where('account_id',$request->content_ids[$index])->first();
                        $updatedBalanceAcc = $accountBal->balance +  $request->amount[$index];
                        $accountBal->balance = $updatedBalanceAcc;
                        $accountBal->save();
                        
                        // Insert Account Ledeger 
                        $CashAccledgerObj = new CashAccountledger;
                        $CashAccledgerObj->received =  $request->amount[$index];
                        $CashAccledgerObj->account_id = $request->content_ids[$index];
                        $CashAccledgerObj->balance = $updatedBalanceAcc;
                        $CashAccledgerObj->payment_id = $paymentObj->id;
                        $CashAccledgerObj->user_id = Auth::user()->id;
                        $CashAccledgerObj->save();

                    }

                    if($ctr_res == 'Customer'){
                        // Update Custoemr Balance 
                            $CustomerBal = CustomerBalance::where('customer_id',$request->content_ids[$index])->first();
                            $custUpdatedBalance = $CustomerBal->balance +  $request->amount[$index];
                            $CustomerBal->balance = $custUpdatedBalance;
                            $CustomerBal->save();
                        // Insert Customer Ledeger 
                        $CustomerledgerObj = new Customerledger;
                        $CustomerledgerObj->received = $request->amount[$index];
                        $CustomerledgerObj->customer_id = $request->content_ids[$index];
                        $CustomerledgerObj->balance = $custUpdatedBalance;
                        $CustomerledgerObj->payment_id = $paymentObj->id;
                        $CustomerledgerObj->user_id = Auth::user()->id;
                        $CustomerledgerObj->save();
                    }
                }
                // Update Account Balance 

                // Update Uper Account Balance
                $accountBalUpper = CashAccountsBal::where('account_id',$request->payment_from)->first();
                $updatedBalance = $accountBalUpper->balance - $request->total_payments;
                $accountBalUpper->balance = $updatedBalance;
                $accountBalUpper->save();
                // Insert Account Ledeger 
                $CashAccledgerObj = new CashAccountledger;
                $CashAccledgerObj->payment = $request->total_payments;
                $CashAccledgerObj->account_id = $request->payment_from;
                $CashAccledgerObj->balance = $updatedBalance;
                $CashAccledgerObj->payment_id = $paymentObj->id;
                $CashAccledgerObj->user_id = Auth::user()->id;
                $CashAccledgerObj->save();

                
                DB::commit();
                
                return redirect('/payments-list')->with(['success'=>'Payment Added Successfully']);
            } catch (\PDOException $e) {
                // Woopsy
                echo $e;
                DB::rollBack();
                return redirect('/payments-list')->with(['success'=>'Payment Added Successfully']);
                // die;
                // 
            }
        }else{
            return redirect('/payments-list')->with(['success'=>'Payment Added Successfully']);
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
}
