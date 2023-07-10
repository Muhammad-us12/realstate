<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\FollowUpCategory;
use App\Models\Clients\FollowUpSubCategory;
use Illuminate\Http\Request;
use Auth;
use DB;

class FollowUpCatController extends Controller
{
    //
    public function follow_up_categories(){
        $allCategories = FollowUpCategory::all();
        return view('adminPanel.members.Clients.follow_up_cat_list',compact('allCategories'));
    }

    public function follow_up_sub_categories(){
        $allCategories = FollowUpCategory::all();
        $allSubCategories = FollowUpSubCategory::all();
        return view('adminPanel.members.Clients.follow_up_sub_cat_list',compact('allSubCategories','allCategories'));
    }

    public function follow_up_cat_submit(Request $request)
    {
        //
        $followUpCategory =  new FollowUpCategory;
        $followUpCategory->follow_up_name = $request->exp_category_name;
        $result = $followUpCategory->save();
        if($result){
            return redirect()->back()->with(['success'=>'Follow Up Category is Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
        // print_r($request->all());
    }

    public function follow_up_sub_cat_submit(Request $request)
    {
        //
        $followUpsubCategory =  new FollowUpSubCategory;
        $followUpsubCategory->follow_up_sub_category = $request->exp_sub_category;
        $followUpsubCategory->category_id = $request->category_id;
        $followUpsubCategory->user_id = Auth::user()->id;
        $result = $followUpsubCategory->save();
        if($result){
            return redirect()->back()->with(['success'=>'Follow Up Sub Category Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
        // print_r($request->all());
    }

    public function fetch_sub_category(Request $request)
    {
        $sub_categories = expenseSubCategory::where('category_id',$request->category_id)
        ->select('id','exp_sub_category')
        ->get();
        
        return $sub_categories;
        // print_r($location_socities);
        // echo "Socitites Function is call now ";
    }

    public function follow_up_cat_update(Request $request)
    {
        //
        // dd($request->all());
        $followUpCategory =  FollowUpCategory::find($request->category_id);
        $followUpCategory->follow_up_name = $request->category_name;
        $result = $followUpCategory->update();
        
         if($result){
            return redirect()->back()->with(['success'=>'Follow Up Category is Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }
    
    public function follow_up_sub_cat_update(Request $req){
        
        $result = DB::table('follow_up_sub_categories')->where('id',$req->exp_sub_id)->update([
                        'follow_up_sub_category'=>$req->exp_sub_category,
                        'category_id'=>$req->category_id,
                    ]);
      
        if($result){
            return redirect()->back()->with(['success'=>'Follow Up Sub Category Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }

}
