@extends('layouts.master')

@section('content')
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Blog</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">

                        @isset($blogs_data)
                            @foreach($blogs_data as $blog_res)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="{{ asset('public/images/blogs/'.$blog_res->picture.'')  }}" alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3>{{ date('d',strtotime($blog_res->created_at)) }}</h3>
                                        <p>{{ date('M-Y',strtotime($blog_res->created_at)) }}</p>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{ URL::to('blog-details/'.$blog_res->id.'') }}">
                                        <h2>{{  $blog_res->title }}</h2>
                                    </a>
                                    <p>{{  Str::limit($blog_res->short_description,120) }}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-user"></i>{{ $blog_res->BlogCategory->category_name }}</a></li>
                                        <!-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> -->
                                    </ul>
                                </div>
                            </article>
                            @endforeach
                        @endisset

                        

                        {!! $blogs_data->links() !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Search Keyword'">
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