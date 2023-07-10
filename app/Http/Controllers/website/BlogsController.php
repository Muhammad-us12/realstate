<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\website\BlogCategory;
use App\Models\website\Blogs;




class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blogs_data = Blogs::orderBy("id","desc")->paginate(20);
        return view('adminPanel.blogs.blogList',compact('blogs_data'));

        // $blogs_data = BlogCategory::find(3)->CategoryBlogs;

        // $blogs_data = Blogs::find(1);

        // $blogs_d = $blogs_data->BlogCategory;
        // dd($blogs_d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $allCategories = BlogCategory::all();
        return view('adminPanel.blogs.addBlog',compact('allCategories'));
    }

    public function blogs_categories(){
        $allCategories = BlogCategory::all();
        return view('adminPanel.blogs.categoryList',compact('allCategories'));
    }

    public function getCategories($id){
        $Category_data = BlogCategory::find($id);
        return json_decode($Category_data);
    }

    public function update_blog_status(Request $request){
        $result = Blogs::find($request->blog_id)->update([
            'status'=>$request->status
        ]);

        if($result){
            return redirect()->back()->with(['success'=>'Blog status is updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went.Please Wrong Try Again']);
        }
    }

    public function updateCategory(Request $request){
        $result = BlogCategory::find($request->category_id)->update([
            'category_name' => $request->category_name
        ]);

        if($result){
            return redirect()->back()->with(['success'=>'Blog Category is Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went.Please Wrong Try Again']);
        }
        // return json_decode($Category_data);
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
            'description' => 'required|max:4294967295',
            'picture'=>'required|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        $BlogObj = new Blogs;

        $BlogObj->title = $request->title;
        $BlogObj->description = $request->description;
        $BlogObj->short_description = $request->short_description;
        $BlogObj->blog_category = $request->blog_category;
        $BlogObj->status = 'pending';
        if($request->file('picture')){
            
            $img_file = $request->file('picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($img_file->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
            $upload = 'public/images/blogs';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $BlogObj->picture = $img_name;
                $BlogObj->user_id = Auth::user()->id;

                $result = $BlogObj->save();
                if($result){
                    return redirect('/blogs-list')->with(['success'=>'Blog is Added Successfully']);
                }else{
                    return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
                }
            }
        }
    }

    public function storeCategory(Request $request)
    {
        //
        $blogCategory =  new BlogCategory;
        $blogCategory->category_name = $request->category_name;
        $result = $blogCategory->save();
        if($result){
            return redirect()->back()->with(['success'=>'Blog Category is Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something Went Wrong Try Again']);
        }
        // print_r($request->all());
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
        $blogs_data = Blogs::find($id);
        $allCategories = BlogCategory::all();
        return view('adminPanel.blogs.editBlog',compact('blogs_data','allCategories'));
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
            $upload = 'public/images/blogs';
            $file_upload = $img_file->move($upload,$img_name);
            if($file_upload){
                $result = Blogs::find($id)->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'blog_category' => $request->blog_category,
                    'picture' => $img_name
                ]);
            }
        }else{
            $result = Blogs::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'blog_category' => $request->blog_category
            ]);

            
        }

        if($result){
            return redirect()->back()->with(['success'=>'Blog is updated Successfully']);
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
