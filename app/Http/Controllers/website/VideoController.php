<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\website\VideoCategory;
use App\Models\website\Video;
use App\Models\locations\Societies;

use Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $video_data = Video::orderBy("id","desc")->paginate(10);
        return view('adminPanel.videos.videosList',compact('video_data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $allCategories = VideoCategory::all();
        $societies_data = Societies::all();
        return view('adminPanel.videos.videosAdd',compact('allCategories','societies_data'));
    }

    public function videos_categories(){
        $allCategories = VideoCategory::all();
        return view('adminPanel.videos.videoCatList',compact('allCategories'));
    }

    public function update_video_status(Request $request){
        $result = Video::find($request->blog_id)->update([
            'status'=>$request->status
        ]);

        if($result){
            return redirect()->back()->with(['success'=>'Video status is updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went.Please Wrong Try Again']);
        }
    }

    public function edit($id)
    {
        //
        $video_data = Video::find($id);
        $allCategories = VideoCategory::all();
        $societies_data = Societies::all();
        return view('adminPanel.videos.videosUpdate',compact('video_data','allCategories','societies_data'));
    }

    public function updateCategory(Request $request){
        $result = VideoCategory::find($request->category_id)->update([
            'category_name' => $request->category_name
        ]);

        if($result){
            return redirect()->back()->with(['success'=>'Video Category is Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went.Please Wrong Try Again']);
        }
        // return json_decode($Category_data);
    }

    public function storeCategory(Request $request)
    {
        //
        $videoCategory =  new VideoCategory;
        $videoCategory->category_name = $request->category_name;
        $result = $videoCategory->save();
        if($result){
            return redirect()->back()->with(['success'=>'Video Category is Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
        // print_r($request->all());
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
            'title' => 'required|max:255',
            'video_category' => 'required',
            'scoiety_id' => 'required',
            'video_link'=>'required',
            'description' => 'required|max:4294967295',
        ]);

        $videoObj = new Video;

        $videoObj->title = $request->title;
        $videoObj->description = $request->description;
        $videoObj->video_category = $request->video_category;
        $videoObj->video_link = $request->video_link;
        $videoObj->scoiety_id = $request->scoiety_id;
        $videoObj->user_id = Auth::user()->id;
        $result = $videoObj->save();
        if($result){
            return redirect('/videos-list')->with(['success'=>'Video Added Successfully']);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
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
            'video_category' => 'required',
            'scoiety_id' => 'required',
            'video_link'=>'required',
            'description' => 'required|max:4294967295',
        ]);

        $videoObj =  Video::find($request->video_id);

        $videoObj->title = $request->title;
        $videoObj->description = $request->description;
        $videoObj->video_category = $request->video_category;
        $videoObj->video_link = $request->video_link;
        $videoObj->scoiety_id = $request->scoiety_id;
        $videoObj->user_id = Auth::user()->id;
        $result = $videoObj->update();

        if($result){
            return redirect()->back()->with(['success'=>'Video is updated Successfully']);
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
