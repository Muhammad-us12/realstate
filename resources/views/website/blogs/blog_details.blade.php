@extends('layouts.master')

@section('content')
<div class="bradcam_area bradcam_bg_1">
                 <div class="container">
                     <div class="row">
                         <div class="col-xl-12">
                             <div class="bradcam_text text-center">
                                 <h3>Blog Details</h3>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!--/ bradcam_area  -->

   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" src="{{ asset('public/images/blogs/'.$blogs_data->picture.'') }}" alt="">
                  </div>
                  <div class="blog_details">
                     <h2>
                        {{ $blogs_data->title }}
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="fa fa-user"></i>{{ $blogs_data->BlogCategory->category_name }}</a></li>
                        <!-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> -->
                     </ul>
                     <p class="excert">
                        {{  $blogs_data->short_description }}
                     </p>
                     <p>
                        {!! $blogs_data->description !!}
                     </p>
                  
                     
                  </div>
               </div>
               
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget search_widget">
                     <form action="#">
                        <div class="form-group">
                           <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder='Search Keyword'
                                 onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                              <div class="input-group-append">
                                 <button class="btn" type="button"><i class="ti-search"></i></button>
                              </div>
                           </div>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                           type="submit">Search</button>
                     </form>
                  </aside>

                  <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                @isset($allCategories)
                                    @foreach($allCategories as $all_cat_res)
                                <li>
                                    <a href="{{ URL::to('category-blogs/'.$all_cat_res->id.'') }}" class="d-flex">
                                        <p>{{ $all_cat_res->category_name }}</p>
                                        <p> ({{ $all_cat_res->blogsCount() }}) </p>
                                    </a>
                                </li>
                                    @endforeach
                                @endisset
                                
                            </ul>
                    </aside>
                 
               </div>
            </div>
         </div>
      </div>
   </section>
@endsection