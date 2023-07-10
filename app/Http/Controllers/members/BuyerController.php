<?php

namespace App\Http\Controllers\members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\persons\Buyers;
use App\Models\persons\BuyerBalance;
use Auth;
use DB;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $buyersData = Buyers::orderBy("id","desc")->paginate(10);
        return view('adminPanel.members.buyersList',compact('buyersData'));
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
        return view('adminPanel.members.addBuyer',compact('countriesList'));
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
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'email' => 'required|max:250',
            'CNIC' => 'required|unique:buyers',
            'city' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'balance' => 'required|integer',
            'picture'=>'mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        $buyersObj = new Buyers;
        $buyersObj->fname = $request->fname;
        $buyersObj->lname = $request->lname;
        $buyersObj->email = $request->email;
        $buyersObj->CNIC = $request->CNIC;
        $buyersObj->buyer_type = $request->buyer_type;
        $buyersObj->city = $request->city;
        $buyersObj->phone = $request->phone;
        $buyersObj->address = $request->address;
        $buyersObj->country = $request->country;
        $buyersObj->opening_bal = $request->balance;

        if($request->file('picture')){
            
            $img_file = $request->file('picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/persons';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $buyersObj->picture = $img_name;
                $buyersObj->user_id = Auth::user()->id;

                $buyerBalObj = new BuyerBalance;
                $buyerBalObj->balance = $request->balance;

                try {
                    DB::transaction(function() use ($buyersObj, $buyerBalObj) {
                        $buyersObj->save();
                        $buyerBalObj->buyer_id = $buyersObj->id;
                        $buyerBalObj->save();
                    });
                    return redirect('/buyers-list')->with(['success'=>'Buyer Added Successfully']);
                } catch (\PDOException $e) {
                    // Woopsy
                    DB::rollBack();
                    return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
                }
                

                
                // if($result){
                //     return redirect('/agents-list')->with(['success'=>'Agent is Added Successfully']);
                // }else{
                //     return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
                // }
                    
            }
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
        return view('adminPanel.members.buyerProfile');
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
        $buyerData = Buyers::find($id);
        $countriesList = DB::table('country')->get();
        return view('adminPanel.members.buyerUpdate',compact('buyerData','countriesList'));
   
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
        $validated = $request->validate([
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'email' => 'required|max:250',
            'CNIC' => 'required',
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

                $result = Buyers::find($id)->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'email' => $request->email,
                    'CNIC' => $request->CNIC,
                    'buyer_type' => $request->buyer_type,
                    'city' => $request->city,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'country' => $request->country,
                    'picture' => $img_name,
                ]);
            }
        }else{
            
            $result = Buyers::find($id)->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'CNIC' => $request->CNIC,
                'buyer_type' => $request->buyer_type,
                'city' => $request->city,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country,
            ]);         
        }

        if($result){
            return redirect()->back()->with(['success'=>'Buyer updated Successfully']);
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
}
