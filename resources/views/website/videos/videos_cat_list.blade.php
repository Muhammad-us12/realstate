@extends('layouts.master')

@section('content')
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Videos</h3>
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

                        @isset($video_data)
                            @foreach($video_data as $video_res)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                <iframe width="100%" height="400" id="video_iframe"
                                                                    src="https://www.youtube.com/embed/{{ $video_res->video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                
                                    <!-- <img class="card-img rounded-0" src="public/images/offers/{{ $video_res->picture }}" alt=""> -->
                                    <a href="#" class="blog_item_date">
                                        <h3>{{ date('d',strtotime($video_res->created_at)) }}</h3>
                                        <p>{{ date('M-Y',strtotime($video_res->created_at)) }}</p>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{ URL::to('video-details/'.$video_res->id.'') }}">
                                        <h2>{{  $video_res->title }}</h2>
                                    </a>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-user"></i>{{ $video_res->VideoCategory->category_name }}</a></li>
                                        <li><a href="#"><i class="fa fa-comments"></i> Society: {{ $video_res->OfferSociety->society_name }}</a></li>
                                    </ul>
                                   
                                                               
                                                                    
                                </div>
                            </article>
                            @endforeach
                        @endisset

                        

                        {!! $video_data->links() !!}
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
                                    <a href="{{ URL::to('category-videos/'.$all_cat_res->id.'') }}" class="d-flex">
                                        <p>{{ $all_cat_res->category_name }}</p>
                                        <p> ({{ $all_cat_res->VideoCount() }}) </p>
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