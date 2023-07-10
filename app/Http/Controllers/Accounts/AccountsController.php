<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts\CashAccounts;
use App\Models\Accounts\CashAccountsBal;
use App\Models\Accounts\CashAccountledger;
use App\Models\Accounts\CashAccountDeposit;
use App\Models\persons\Agent;
use App\Models\persons\Customers;

use App\Models\locations\Files;
use App\Models\locations\LocalProperty;
use App\Models\expense\expense;

use Carbon\Carbon;


use App\Models\persons\AgentLedeger;
use Auth;
use DB;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $CashAccountsdata = CashAccounts::paginate(10);
        return view('adminPanel.accounts.accountsList',compact('CashAccountsdata'));
    }
    
    public function cash_deposit_print($id)
    {
        //
         $cash_deposit_data = CashAccountDeposit::find($id);
        return view('adminPanel.accounts.cash_deposit_print',compact('cash_deposit_data'));
    }
    
    

    public function reports_list(){
        return view('adminPanel.accounts.reports_list');
    }

    public function payable_receivable(){
        $customers = DB::table('customers')
                            ->join('customer_balances', 'customer_balances.customer_id', '=', 'customers.id')// joining the contacts table , where user_id and contact_user_id are same
                            
                            ->select('customer_balances.*', 'customers.custfname','customers.custlname')
                            ->orderBy("id",'asc')
                            ->get();
        $agents = DB::table('agents')
                            ->join('agent_balances', 'agent_balances.agent_id', '=', 'agents.id')// joining the contacts table , where user_id and contact_user_id are same
                            
                            ->select('agent_balances.*', 'agents.fname','agents.lname')
                            ->orderBy("id",'asc')
                            ->get();

        return view('adminPanel.accounts.payable_receivable',compact('customers','agents'));
        // print_r($customers);
        // die;
    }

    public function fetch_account_list(){
        $accountsList = CashAccounts::all();
        return $accountsList;
    }

    public function fetch_cash_acc_bal($id)
    {
    //    echo "The id is $id";
       $accountBalance = CashAccountsBal::where('account_id',$id)->first();
       return $accountBalance->balance;
    //    print_r($accountBalance);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adminPanel.accounts.addAccount');
    }

    public function cashDeposit()
    {
        //
        $CashAccountsdata = CashAccounts::all();
        $CashAccountDeposit = CashAccountDeposit::orderBy('created_at', 'desc')->paginate(10);
        return view('adminPanel.accounts.cashDeposit',compact('CashAccountsdata','CashAccountDeposit'));
    }

    public function accountLedeger($id)
    {
        //
        $CashAccountsdata = CashAccountledger::where('account_id',$id)->paginate(500);
        // print_r($CashAccountsdata);
        // die;
        return view('adminPanel.accounts.cashAccountLedeger',compact('CashAccountsdata'));
    }
    
    public function ledger_reports(){
        $CashAccountsdata = CashAccounts::all();
        $agentdata = Agent::all();
        return view('adminPanel.accounts.ledegers_reports',compact('CashAccountsdata','agentdata'));
    }
    

    public function print_cash_account_ledeger(Request $request)
    {
        //
        $CashAccountsdata = CashAccounts::find($request->account_id);
        $CashAccountsLedeger = CashAccountledger::where('account_id',$request->account_id)->get();
        // print_r($CashAccountsLedeger);
        // die;
        return view('adminPanel.accounts.cashAccountLedegerPrint',compact('CashAccountsLedeger','CashAccountsdata'));
    }

    public function print_agent_account_ledeger(Request $request)
    {
        //
        $agent_data = Agent::find($request->agent_id);
        $agentLedeger = AgentLedeger::where('agent_id',$request->agent_id)->get();
        // print_r($agentLedeger);
        // die;
        return view('adminPanel.accounts.agentLedegerPrint',compact('agentLedeger','agent_data'));
    }

    

    public function date_wise_cash_account_ledeger(Request $request)
    {
        //
        // print_r($request->all());
        $CashAccountsdata = CashAccounts::find($request->account_id);
        $CashAccountsLedeger = CashAccountledger::
        whereBetween(\DB::raw('DATE(created_at)'), [$request->start_date,$request->end_date])
        ->where('account_id',$request->account_id)
        ->get();
        // print_r($CashAccountsLedeger);
        // die;
        return view('adminPanel.accounts.dateWiseCashAccLedeger',compact('CashAccountsLedeger','CashAccountsdata','request'));
    }

    public function date_wise_agent_account_ledeger(Request $request)
    {
        //
        // print_r($request->all());
        $agent_data = Agent::find($request->agent_id);
        $agentLedeger = AgentLedeger::
        whereBetween(\DB::raw('DATE(created_at)'), [$request->start_date,$request->end_date])
        ->where('agent_id',$request->agent_id)
        ->get();
        // print_r($CashAccountsLedeger);
        // die;
        return view('adminPanel.accounts.dateWiseAgentAccLedeger',compact('agentLedeger','agent_data','request'));
    }

    public function profit_report(){
   

        $sale_files = Files::where('status','sale')->select('id','purchase_amount','sale_amount','commission_amount')->get();
        $localproperty = LocalProperty::where('status','sale')->select('id','commission_amount')->get();
        $expense = expense::all()->sum('total_amount');
        
        // dd($expense);
        return view('adminPanel.accounts.profit_report',compact('sale_files','localproperty','expense'));
    }
    
      public function date_wise_profit_report_sub(Request $request){
   

        $sale_files = Files::where('status','sale')->select('id','purchase_amount','sale_amount','commission_amount')
                        ->whereBetween('sold_date',[$request->start_date,$request->end_date])
                        ->get();
        $localproperty = LocalProperty::where('status','sale')->select('id','commission_amount')
                        ->whereBetween('sold_date',[$request->start_date,$request->end_date])
                        ->get();
        $expense = expense::whereBetween('date', [$request->start_date,$request->end_date])->sum('total_amount');
        
        // dd($expense);
        return view('adminPanel.accounts.date_wise_profit_report_print',compact('sale_files','localproperty','expense','request'));
    }
    
    
    
    public function date_wise_profit_report(){
        
        
        return view('adminPanel.accounts.date_wise_profit_report');
    }

    public function dashboard(){
        $sales_files = Files::where('status','sale')->sum('sale_amount');
        $sales_files_count = Files::where('status','sale')->count();
        $purchase_files = Files::where('status','sale')->sum('purchase_amount');
        $purchase_files_count = Files::where('status','Purchase')->count();
        $localproperty = LocalProperty::where('status','sale')->sum('commission_amount');
        $localpropertyCount = LocalProperty::where('status','sale')->count();
        $expense = expense::all()->sum('total_amount');
        $today_expense = expense::where('date',date('Y-m-d'))->sum('total_amount');
        $today_expense_count = expense::where('date',date('Y-m-d'))->count();
        
        $expenseCount = expense::all()->count();

        // dd($today_expense);
         // Replace with the desired year

        $currentYear = date('Y');

        $purchase_month_ar = [];
        $expense_month_ar = [];
        for($x = 1; $x<=12; $x++){
            $data = DB::table('files')
                ->whereYear('purchase_date', $currentYear)
                ->whereMonth('purchase_date', $x)
                ->sum('purchase_amount');

            $total_puchase_month = DB::table('files')
                                    ->where('status','sale')
                                    ->whereYear('purchase_date', $currentYear)
                                    ->whereMonth('purchase_date', $x)
                                    ->sum('purchase_amount');
            $data = (float)$data;
            array_push($purchase_month_ar,$data);
            
            $allExpense = DB::table('expenses')
                ->whereYear('date', $currentYear)
                ->whereMonth('date', $x)
                ->sum('total_amount');
            $allExpense = (float)$allExpense;
            array_push($expense_month_ar,$allExpense);
            // print_r($data);
        }

        $currentYear = date('Y');
        $currentMonth = date('m');

        $month_names = [];
        $total_profit = [];
        for($x = 1; $x<=$currentMonth; $x++){
            

            $total_puchase_month = DB::table('files')
                                    ->where('status','sale')
                                    ->whereYear('sold_date', $currentYear)
                                    ->whereMonth('sold_date', $x)
                                    ->sum('purchase_amount');
            
            $total_sale_month = DB::table('files')
                                    ->where('status','sale')
                                    ->whereYear('sold_date', $currentYear)
                                    ->whereMonth('sold_date', $x)
                                    ->sum('sale_amount');

            $total_commission_month = DB::table('files')
                                    ->where('status','sale')
                                    ->whereYear('sold_date', $currentYear)
                                    ->whereMonth('sold_date', $x)
                                    ->sum('commission_amount');

            $total_commission_month_property = DB::table('local_properties')
                                    ->where('status','sale')
                                    ->whereYear('sold_date', $currentYear)
                                    ->whereMonth('sold_date', $x)
                                    ->sum('commission_amount');

            $total_expense = DB::table('expenses')
                                    ->whereYear('date', $currentYear)
                                    ->whereMonth('date', $x)
                                    ->sum('total_amount');
                                    

            $file_profit = ($total_sale_month - $total_puchase_month) - $total_commission_month;
            $file_profit += $total_commission_month_property;
            $net_profit = $file_profit;
            $net_profit -= $total_expense;

            $month = Carbon::create($currentYear, $x, 1);
            $monthName = $month->format('F');
            $monthName = (string)$monthName;
            $net_profit = (float)$net_profit;
            array_push($month_names,$monthName);
            array_push($total_profit,$net_profit);
            // print_r($data);
        }

     



        $sale_month_ar = [];
        for($x = 1; $x<=12; $x++){
            $data = DB::table('files')
                ->whereYear('sold_date', $currentYear)
                ->whereMonth('sold_date', $x)
                ->sum('sale_amount');
                
            $data = (float)$data;
            array_push($sale_month_ar,$data);
            // print_r($data);
        }
    
        // Today Profit
            $today_puchase = DB::table('files')
                                    ->where('status','sale')
                                    ->where('sold_date', date('Y-m-d'))
                                    ->sum('purchase_amount');
            
            $today_sale = DB::table('files')
                                    ->where('status','sale')
                                    ->where('sold_date', date('Y-m-d'))
                                    ->sum('sale_amount');

            $today_commission = DB::table('files')
                                    ->where('status','sale')
                                    ->where('sold_date', date('Y-m-d'))
                                    ->sum('commission_amount');

            $today_commission_property = DB::table('local_properties')
                                    ->where('status','sale')
                                    ->where('sold_date', date('Y-m-d'))
                                    ->sum('commission_amount');

            $total_today_expense = DB::table('expenses')
                                    ->where('date', date('Y-m-d'))
                                    ->sum('total_amount');
                                    

            $file_profit_today = ($today_sale - $today_puchase) - $today_commission;
            $file_profit_today += $today_commission_property;
            $today_profit = $file_profit_today;
            $today_profit -= $total_today_expense;
        return view('adminPanel/dashboard',compact('sales_files','purchase_files',
        'localproperty','expense','sales_files_count','purchase_files_count','localpropertyCount','today_profit'
        ,'expenseCount','purchase_month_ar','sale_month_ar','month_names','total_profit','expense_month_ar','today_expense','today_expense_count'));
    }
    
    


    public function cashDepositSub(Request $request){
        $validated = $request->validate([
            'deposit_amount' => 'required|integer',
            'deposit_by' => 'required|max:50',
        ]);

        // Save Cash Deposit
        $CashAccDepObj = new CashAccountDeposit;
        $CashAccDepObj->deposit_amount = $request->deposit_amount;
        $CashAccDepObj->deposit_by = $request->deposit_by;
        $CashAccDepObj->insevter_name = $request->insevter_name;
        $CashAccDepObj->account_id = $request->account_id;
        $CashAccDepObj->user_id = Auth::user()->id;

        // Update Account Balance 
        $accountBal = CashAccountsBal::where('account_id',$request->account_id)->first();
        $updatedBalance = $accountBal->balance + $request->deposit_amount;
        $accountBal->balance = $updatedBalance;
       
        $CashAccledgerObj = new CashAccountledger;
        $CashAccledgerObj->received = $request->deposit_amount;
        $CashAccledgerObj->account_id = $request->account_id;
        $CashAccledgerObj->balance = $updatedBalance;
        $CashAccledgerObj->insevter_name = $request->insevter_name;
        
        $CashAccledgerObj->user_id = Auth::user()->id;

        try {
            DB::transaction(function() use ($CashAccDepObj, $CashAccledgerObj,$accountBal) {
                $CashAccDepObj->save();
                $CashAccledgerObj->deposit_id = $CashAccDepObj->id;
                $accountBal->update();
                $CashAccledgerObj->save();


            });
            return redirect('/accounts-list')->with(['success'=>'Account Added Successfully']);
        } catch (\PDOException $e) {
            // Woopsy
            echo $e;
            DB::rollBack();
            // return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'account_name' => 'required|max:50|unique:cash_accounts',
            'account_number' => 'required|max:50',
            'opening_bal' => 'required|integer',
        ]);

        $CashAccountsObj = new CashAccounts;
        $CashAccountsObj->account_name = $request->account_name;
        $CashAccountsObj->account_number = $request->account_number;
        $CashAccountsObj->opening_bal = $request->opening_bal;
        $CashAccountsObj->user_id = Auth::user()->id;
       
        $CashAccountsBalObj = new CashAccountsBal;
        $CashAccountsBalObj->balance = $request->opening_bal;

        try {
            DB::transaction(function() use ($CashAccountsObj, $CashAccountsBalObj) {
                $CashAccountsObj->save();
                $CashAccountsBalObj->account_id = $CashAccountsObj->id;
                $CashAccountsBalObj->save();
            });
            return redirect('/accounts-list')->with(['success'=>'Account Added Successfully']);
        } catch (\PDOException $e) {
            // Woopsy
            // echo $e;
            DB::rollBack();
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
