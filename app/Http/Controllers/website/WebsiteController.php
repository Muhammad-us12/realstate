<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\locations\Societies;
use App\Models\website\BlogCategory;
use App\Models\website\Blogs;

use App\Models\website\OffersCategory;
use App\Models\website\Offers;

use App\Models\website\VideoCategory;
use App\Models\website\Video;
use App\Models\Location;
use App\Models\locations\LocalProperty;
use App\Models\persons\Agent;



class WebsiteController extends Controller
{
    //

    public function contact_us(){
        return view('website.contact_us');
    }

    public function about_us(){
        $agents = Agent::where('display_on_web',1)->orderBy("id","desc")->limit(4)->get();
        return view('website.about_us',compact('agents'));
    }
    
    public function contact_us_messages_list(){
        $contact_us = \DB::table('contact_us_queries')->orderBy("id","desc")->paginate(10);
        
        return view('adminPanel.videos.contact_us_quries',compact('contact_us'));
    }
    
    public function delete_query($id){
        $result = \DB::table('contact_us_queries')->where('id',$id)->delete();
        if($result){
            return redirect()->back()->with(['success'=>'Your Query Deleted Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }

    

    public function contact_us_sub(Request $request){
        // print_r($request->all());
        $result = \DB::table('contact_us_queries')->insert([
                        'message'=>$request->message,
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'subject'=>$request->subject,
                    ]);
        if($result){
            return redirect()->back()->with(['success'=>'Your Query is Submited Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
    }
    public function index(){
        $Location_data = Location::all();
        // $societies_data = Societies::all();
        $scoeities = Societies::where('display_on_web',1)->orderBy("id","desc")->limit(6)->get();
        $local_properties = LocalProperty::where('status','!=','sale')->select('title','img','area','id','marala_type','street_size','demand_amount','location_id','society_id')->orderBy("id","desc")->limit(5)->get();
        
        $agents = Agent::where('display_on_web',1)->orderBy("id","desc")->limit(4)->get();
        return view('website.index',compact('scoeities','Location_data','local_properties','agents'));
    }

    public function all_societies_display(){
        $Location_data = Location::all();
        $scoeities = Societies::select('id','society_name','location','picture')->orderBy("id","asc")->paginate(10);;
        return view('website.all_societies_display',compact('scoeities','Location_data'));
    }

    public function all_team_members(){
        $Location_data = Location::all();
        $agents = Agent::where('status','Active')->select('id','fname','lname','picture')->orderBy("id","asc")->paginate(10);;
        return view('website.all_team_members',compact('agents','Location_data'));
    }

    
    

    public function search_property(Request $request){
        $Location_data = Location::all();
        $properties = LocalProperty::where('location_id',$request->location)
                        ->where('society_id',$request->society_id)
                        ->where('state_type',$request->property_type)
                        ->get();
        // print_r($properties);
        return view('website.search_property_list',compact('properties','Location_data'));
    }

    public function property_detail($id){
        $properties = LocalProperty::find($id);
        return view('website.property_detail',compact('properties'));
    }
    
    public function society_detail($id){
        $soceity_data = Societies::find($id);
        return view('website.society_detail',compact('soceity_data'));
    }

    public function blog_list()
    {
        //
        $blogs_data = Blogs::where('status','publish')->orderBy("id","desc")->paginate(10);
        $allCategories = BlogCategory::all();

        
        return view('website.blogs.blogs_list',compact('blogs_data','allCategories'));
       
    }

    public function offers_list()
    {
        //
        $offers_data = Offers::where('status','publish')->orderBy("id","desc")->paginate(10);
        $allCategories = OffersCategory::all();

        
        return view('website.offers.offers_list',compact('offers_data','allCategories'));
       
    }

    public function category_blogs($id)
    {
        $blogs_data = Blogs::where('status','publish')
        ->where('blog_category',$id)
        ->orderBy("id","desc")->paginate(10);
        $allCategories = BlogCategory::all();

        
        return view('website.blogs.category_blogs_list',compact('blogs_data','allCategories'));
    }

    public function category_offers($id)
    {
        $offers_data = Offers::where('status','publish')
        ->where('offer_category',$id)
        ->orderBy("id","desc")->paginate(10);
        $allCategories = OffersCategory::all();

        // print_r($offers_data);
        // die;
        return view('website.offers.category_offers_list',compact('offers_data','allCategories'));
    }

    public function category_videos($id)
    {
        $video_data = Video::where('status','publish')
        ->where('video_category',$id)
        ->orderBy("id","desc")->paginate(10);
        $allCategories = VideoCategory::all();

        // print_r($offers_data);
        // die;
        return view('website.videos.videos_cat_list',compact('video_data','allCategories'));
    }

    

    public function blog_details($id)
    {
        $blogs_data = Blogs::find($id);
        $allCategories = BlogCategory::all();

        
        return view('website.blogs.blog_details',compact('blogs_data','allCategories'));
    }

    public function offers_details($id)
    {
        $offer_data = Offers::find($id);
        $allCategories = OffersCategory::all();

        
        return view('website.offers.offers_details',compact('offer_data','allCategories'));
    }

    public function videos_list()
    {
        //
        $video_data = Video::where('status','publish')->orderBy("id","desc")->paginate(10);
        $allCategories = VideoCategory::all();

        
        return view('website.videos.videos_list',compact('video_data','allCategories'));
       
    }

    public function video_details($id)
    {
        $video_data = Video::find($id);
        $allCategories = VideoCategory::all();

        
        return view('website.videos.video_details',compact('video_data','allCategories'));
    }
    
    
    

    
}
