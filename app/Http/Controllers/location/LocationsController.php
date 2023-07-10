<?php

namespace App\Http\Controllers\location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Auth;


class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Location_data = Location::orderBy("id","desc")->paginate(10);
        return view('adminPanel.locations.locationsList',compact('Location_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adminPanel.locations.addLocation');
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
            'location_name' => 'required|max:255',
            'description' => 'max:4294967295',
            'picture'=>'required|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        $LocationObj = new Location;
        $LocationObj->location_name = $request->location_name;
        $LocationObj->description = $request->description;
        if($request->file('picture')){
            
            $img_file = $request->file('picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/locations';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $LocationObj->picture = $img_name;
                $LocationObj->user_id = Auth::user()->id;

                $result = $LocationObj->save();
                if($result){
                    return redirect('/locations-list')->with(['success'=>'Location is Added Successfully']);
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
        $Location_data = Location::find($id);
        return view('adminPanel.locations.locationEdit',compact('Location_data'));
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
            'location_name' => 'required|max:255',
            'description' => 'max:4294967295',
            'picture'=>'mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        if($request->file('picture')){
            
            $img_file = $request->file('picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/locations';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $result = Location::find($id)->update([
                    'location_name' => $request->location_name,
                    'description' => $request->description,
                    'picture' => $img_name
                ]);
            }
        }else{
            
            $result = Location::find($id)->update([
                'location_name' => $request->location_name,
                'description' => $request->description,
            ]);            
        }

        if($result){
            return redirect()->back()->with(['success'=>'Location is updated Successfully']);
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
