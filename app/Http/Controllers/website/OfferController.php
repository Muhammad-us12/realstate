<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\website\OffersCategory;
use App\Models\website\Offers;
use App\Models\Location;
use Auth;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $offers_data = Offers::orderBy("id","desc")->paginate(10);
        return view('adminPanel.offers.offerList',compact('offers_data'));

    }

    public function offers_categories(){
        $allCategories = OffersCategory::all();
        return view('adminPanel.offers.offersCatList',compact('allCategories'));
    }

    public function update_offer_status(Request $request){
        $result = Offers::find($request->blog_id)->update([
            'status'=>$request->status
        ]);

        if($result){
            return redirect()->back()->with(['success'=>'Offer status is updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went.Please Wrong Try Again']);
        }
    }

    public function updateCategory(Request $request){
        $result = OffersCategory::find($request->category_id)->update([
            'category_name' => $request->category_name
        ]);

        if($result){
            return redirect()->back()->with(['success'=>'Offer Category is Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went.Please Wrong Try Again']);
        }
        // return json_decode($Category_data);
    }

    public function storeCategory(Request $request)
    {
        //
        $offersCategory =  new OffersCategory;
        $offersCategory->category_name = $request->category_name;
        $result = $offersCategory->save();
        if($result){
            return redirect()->back()->with(['success'=>'Offers Category is Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
        // print_r($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $allCategories = OffersCategory::all();
        $Location_data = Location::all();
        return view('adminPanel.offers.addOffers',compact('allCategories','Location_data'));
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
            'title' => 'required|max:255',
            'offer_category' => 'required',
            'offer_location' => 'required',
            'description' => 'required|max:4294967295',
            'picture'=>'required|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        $offersObj = new Offers;

        $offersObj->title = $request->title;
        $offersObj->description = $request->description;
        $offersObj->offer_category = $request->offer_category;
        $offersObj->offer_location = $request->offer_location;
        $offersObj->status = 'pending';
        if($request->file('picture')){
            
            $img_file = $request->file('picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/offers';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $offersObj->picture = $img_name;
                $offersObj->user_id = Auth::user()->id;

                $result = $offersObj->save();
                if($result){
                    return redirect('/offers-list')->with(['success'=>'Offer Added Successfully']);
                }else{
                    return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
                }
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
        $offer_data = Offers::find($id);
        $allCategories = OffersCategory::all();
        $Location_data = Location::all();
        return view('adminPanel.offers.editOffer',compact('offer_data','allCategories','Location_data'));
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
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:4294967295',
        ]);

        if($request->file('picture')){
            
            $img_file = $request->file('picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/offers';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $result = Offers::find($id)->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'offer_category' => $request->offer_category,
                    'offer_location' => $request->offer_location,
                    'picture' => $img_name
                ]);
            }
        }else{
            $result = Offers::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'offer_category' => $request->offer_category,
                'offer_location' => $request->offer_location,
            ]);

          

        }

        if($result){
            return redirect()->back()->with(['success'=>'Offer is updated Successfully']);
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
