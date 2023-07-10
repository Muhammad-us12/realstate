
@extends('layouts.master')

@section('content')
    <!-- slider_area_start -->
    <div class="slider_area">
            <div class="single_slider  d-flex align-items-center slider_bg_1">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 offset-xl-1">
                                <div class="slider_text text-center justify-content-center">
                                    <h3>THE CHOICE MARKETING</h3>
                                </div>
                                <div  class="slider_text text-center justify-content-center text-white" >
                                    <h3>FIND YOUR BEST PROPERTY</h3>
                                </div>
                                <div class="property_form">
                                    <form action="{{ URL::to('search-property') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form_wrap d-flex">
                                                        <div class="single-field col-lg-4 col-md-4 col-sm-4">
                                                                <label for="#" style="color:white;">Location</label>
                                                                <select class="form-control" onchange="fetchLocatonsSocities()" name="location" id="file_location">
                                                                        @isset($Location_data)
                                                                            @foreach($Location_data as $loca_res)
                                                                        <option value="{{ $loca_res->id }}">{{ $loca_res->location_name }}</option>
                                                                            @endforeach($Location_data)
                                                                        @endisset
                                                                        
                                                                </select>
                                                            </div>
                                                        <div class="single-field col-lg-4 col-md-4 col-sm-4 ">
                                                                <label for="#" style="color:white;">Select Society</label>
                                                                <select class="form-control" id="societies" name="society_id">
                                                                        
                                                                </select>
                                                            </div>
                                                            
                                                        <div class="single-field col-lg-3 col-md-3 col-sm-3 ">
                                                            <label style="color:white;" for="example-input-normal" class="form-label">Sale Type</label>
                                                            <select class="form-control" id="Propertytype" name="property_type" onchange="checkPropertyType()">
                                                                    <option value="Commerical">Commercial</option>
                                                                    <option value="Residentail">Residential</option>
                                                            </select>
                                                            </div>
                                                        
                                                            <div class="serach_icon">
                                                                <button type="submit" class="btn btn-success">
                                                                        <i class="ti-search"></i>
                                                                </button>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <!-- slider_area_end -->
<!--Our vision-->
<div class="jumbotron">
    <h1 class= "text-center bold">Vision/Mission</h1>
    <div class="accordion_area">
            <div class="container">
                <div class="row align-items-center">
                     
                        <div class="col-xl-6 col-lg-6">
                               <div class="row">
                                   <div class="col-xl-12 col-lg-12">
                                      
                                       <p style="text-align:justify;">As an independent brokerage, we are dedicated in providing you with excellent, professional, honest and responsible services We aim to be at the forefront of property marketing, and to provide tailored, innovative solutions that fit our client’s individual property and situations to ensure the best possible outcome is achieved. To make the Buying and Selling of Real Estate as Cost effective as possible while maintaining the highest level of service. we are always standing with our respectable clients To continually explore new ideas and technology, to make selling and buying of Real Estate faster, less costly and easier. we are working every time, every day, every minutes</p>
                                   </div>
                               </div>
                            </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="accordion_thumb">
                            <img src="{{ asset('public/websiteFrontend/img/banner/faqs.jpeg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<!--end our vision-->
    <!-- popular_property  -->
    <div class="popular_property">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-40 text-center">
                        <h1>CURRENT SOCIETIES</h1>
                    </div>
                </div>
            </div>
            <div class="row">
               
                @isset($scoeities)
                    @foreach($scoeities as $society_res)
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_property">
                        <div class="property_thumb">
                            <div class="property_tag">
                                    For Sale
                            </div>
                            <img src="public/images/Societies/{{ $society_res->picture }}" style="height:196px" alt="">
                        </div>
                        <div class="property_content">
                            <div class="main_pro">
                                    <h3><a href="{{ URL::to('society-details/'.$society_res->id.'') }}">{{ Str::limit($society_res->society_name, 30) }}</a></h3>
                                    <div class="mark_pro">
                                        <img src="{{ asset('public/websiteFrontend/img/svg_icon/location.svg') }}" alt="">
                                        <span>{{ $society_res->SocietyLocation->location_name }}</span>
                                    </div>
                                    <!--<span class="amount">From $20k</span>-->
                            </div>
                        </div>
                        <!-- <div class="footer_pro">
                                <ul>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="{{ asset('public/websiteFrontend/img/svg_icon/square.svg') }}" alt="">
                                            <span>1200 Sqft</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="{{ asset('public/websiteFrontend/img/svg_icon/bed.svg') }}" alt="">
                                            <span>2 Bed</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="{{ asset('public/websiteFrontend/img/svg_icon/bath.svg') }}" alt="">
                                            <span>2 Bath</span>
                                        </div>
                                    </li>
                                </ul>
                        </div> -->
                    </div>
                </div>
                    @endforeach
                @endisset
                
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="more_property_btn text-center">
                        <a href="{{ URL::to('all-societies-display') }}" class="boxed-btn3-line">All SOCIETIES</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /popular_property  -->
    
    <!-- home_details  -->
    <div class="home_details">
        <div class="container">
            <div class="row">   
                <div class="col-xl-12">
                    <div class="home_details_active owl-carousel">
                        @isset($local_properties )
                            @foreach($local_properties as $properties)
                        <div class="single_details">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                        <div class="modern_home_info">
                                                <div class="modern_home_info_inner">
                                                    <span class="for_sale">
                                                        For Sale
                                                    </span>
                                                    <div class="info_header">
                                                            <img src="public/images/Societies/{{ $properties->img }}" style="width:100%; height:240px;" alt="">
                                                            <h3 class="mt-3">{{ $properties->title }}</h3>
                                                            <div class="popular_pro d-flex">
                                                                <img src="{{ asset('public/websiteFrontend/img/svg_icon/location.svg') }}" alt="">
                                                                <span>{{ $properties->Propertylocation->location_name }} /{{ $properties->PropertySociety->society_name }}</span>
                                                            </div>
                                                    </div>
                                                    <div class="info_content">
                                                        <ul>
                                                            <li> <img src="{{ asset('public/websiteFrontend/img/svg_icon/square.svg') }}" alt=""> 
                                                            Size<span>{{ $properties->area }}</span>
                                                            </li>
                                                            <li> <img src="{{ asset('public/websiteFrontend/img/svg_icon/bed.svg') }}" alt=""> <span>{{ $properties->PropertyMaral->marala }}</span></li>
                                                            <li> <img src="{{ asset('public/websiteFrontend/img/svg_icon/bath.svg') }}" alt=""> Street Size<span>{{ $properties->street_size }}</span> </li>
                                                        </ul>
                                                        <div class="prise_view_details d-flex justify-content-between align-items-center">
                                                            <span>{{ number_format($properties->demand_amount) }} PKR</span>
                                                            <a class="boxed-btn3-line" href="{{ URL::to('property-detail/'.$properties->id.'') }}">View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @endisset
                       
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /home_details  -->

    <!-- accordion  -->
    <div class="accordion_area">
            <div class="container">
                <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6">
                                <div class="faq_ask">
                                    <h3>Frequently ask</h3>
                                        <div id="accordion">
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                   what is the big real estate site? 
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="">
                                                        <div class="card-body">The Choice Marketing is the largest real estate website in the Pakistan.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                                    what is the best place to do real estate?
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
                                                        <div class="card-body">The Choice Marketing is the best place where you do real estate in Pakistan.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    which is the best real estate market in Pakistan?
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion" style="">
                                                        <div class="card-body">Sheikhupura emerged as on of the most areas in the country for real estate investment.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingFour">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                                                    who is the best property dealer in Pakistan?
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion" style="">
                                                        <div class="card-body">The Choice Marketing in Sheikhupura.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                               
                                            </div>
                                </div>
                            </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="accordion_thumb">
                            <img src="{{ asset('public/websiteFrontend/img/banner/faqs.jpeg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- accordion  -->

    <!-- counter_area  -->
    <div class="counter_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="single_counter">
                        <h3> <span  class="counter" >200</span> <span>+</span> </h3>
                        <p>Properties for sale</p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single_counter">
                        <h3> <span class="counter" >300</span></h3>
                        <p>Properties for sale</p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single_counter">
                        <h3> <span class="counter" >15</span></h3>
                        <p>Properties for sale</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /counter_area  -->

    <!-- testimonial_area  -->
    <div class="testimonial_area overlay ">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="testmonial_active owl-carousel">
                        <div class="single_carousel">
                                <div class="single_testmonial text-center">
                                        <div class="quote">
                                            <img src="{{ asset('public/websiteFrontend/img/svg_icon/quote.svg') }}" alt="">
                                        </div>
                                        <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> 
                                                sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br>
                                                Fusce ac mattis nulla. Morbi eget ornare dui. </p>
                                        <div class="testmonial_author">
                                            <div class="thumb">
                                                    <img src="{{ asset('public/websiteFrontend/img/case/testmonial.png') }}" alt="">
                                            </div>
                                            <h3>Robert Thomson</h3>
                                            <span>Business Owner</span>
                                        </div>
                                    </div>
                        </div>
                        <div class="single_carousel">
                                <div class="single_testmonial text-center">
                                        <div class="quote">
                                            <img src="{{ asset('public/websiteFrontend/img/svg_icon/quote.svg') }}" alt="">
                                        </div>
                                        <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> 
                                                sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br>
                                                Fusce ac mattis nulla. Morbi eget ornare dui. </p>
                                        <div class="testmonial_author">
                                            <div class="thumb">
                                                    <img src="{{ asset('public/websiteFrontend/img/case/testmonial.png') }}" alt="">
                                            </div>
                                            <h3>Robert Thomson</h3>
                                            <span>Business Owner</span>
                                        </div>
                                    </div>
                        </div>
                        <div class="single_carousel">
                                <div class="single_testmonial text-center">
                                        <div class="quote">
                                            <img src="{{ asset('public/websiteFrontend/img/svg_icon/quote.svg') }}" alt="">
                                        </div>
                                        <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> 
                                                sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br>
                                                Fusce ac mattis nulla. Morbi eget ornare dui. </p>
                                        <div class="testmonial_author">
                                            <div class="thumb">
                                                    <img src="{{ asset('public/websiteFrontend/img/case/testmonial.png') }}" alt="">
                                            </div>
                                            <h3>Robert Thomson</h3>
                                            <span>Business Owner</span>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /testimonial_area  -->

    <!-- team_area  -->
    <div class="team_area">
            <div class="container">
                    <div class="row">
                            <div class="col-xl-12">
                                <div class="section_title mb-40 text-center">
                                    <h3>
                                            Our Team
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             @isset($agents)
                                @foreach($agents as $agent_res)
                                <div class="col-xl-3 col-lg-3 col-md-6">
                                    <div class="single_team">
                                        <div class="team_thumb">
                                            <img src="{{ asset('public/images/persons/'.$agent_res->picture.'') }}" style="width:100%;height:255px;" alt="">
                                            <div class="social_link">
                                                    <ul>
                                                        <li><a href="#">
                                                                <i class="fa fa-facebook"></i>
                                                            </a>
                                                        </li>
                                                        <li><a href="#">
                                                                <i class="fa fa-twitter"></i>
                                                            </a>
                                                        </li>
                                                        <li><a href="#">
                                                                <i class="fa fa-instagram"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                        </div>
                                        <div class="team_info text-center">
                                            <h3>{{ $agent_res->fname." ".$agent_res->lname }}</h3>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endisset
                            
                        </div>
                        
                         <div class="row">
                            <div class="col-xl-12">
                                <div class="more_property_btn text-center">
                                    <a href="{{ URL::to('all-team-members') }}" class="boxed-btn3-line">All Team Members</a>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    <!-- /team_area  -->

    <!-- contact_action_area  -->
    <!--<div class="contact_action_area">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-xl-7">-->
    <!--                <div class="action_heading">-->
    <!--                    <h3>Add your property for sale</h3>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-xl-5">-->
    <!--                <div class="call_add_action">-->
    <!--                    <span>+10 637 367 4567</span>-->
    <!--                    <a href="#" class="boxed-btn3-line">Add Property</a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- /contact_action_area  -->

    <!-- footer start -->
    
@endsection

@section('scripts')
<script>

fetchLocatonsSocities = ()=>{
                    $.ajax({
                        url:"{{ URL::to('fetch_socities_wi_location') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'location_id':$('#file_location').val()
                        },
                        success:function(data) {
                            console.log(data);
                            let socititesHtml = ``;
                            data.forEach((scoities)=>{
                                socititesHtml += `<option value="${scoities['id']}">${scoities['society_name']}</option>`
                                
                            });

                            $('#societies').html(socititesHtml);
                        }
                    });
            }

            fetchLocatonsSocities()

        function collision($div1, $div2) {
            var x1 = $div1.offset().left;
            var w1 = 40;
            var r1 = x1 + w1;
            var x2 = $div2.offset().left;
            var w2 = 40;
            var r2 = x2 + w2;

            if (r1 < x2 || x1 > r2)
                return false;
            return true;
        }
        // Fetch Url value 
        var getQueryString = function (parameter) {
            var href = window.location.href;
            var reg = new RegExp('[?&]' + parameter + '=([^&#]*)', 'i');
            var string = reg.exec(href);
            return string ? string[1] : null;
        };
        // End url 
        // // slider call
        $('#slider').slider({
            range: true,
            min: 20,
            max: 200,
            step: 1,
            values: [getQueryString('minval') ? getQueryString('minval') : 20, getQueryString('maxval') ?
                getQueryString('maxval') :200
            ],

            slide: function (event, ui) {

                $('.ui-slider-handle:eq(0) .price-range-min').html( ui.values[0] + 'K');
                $('.ui-slider-handle:eq(1) .price-range-max').html( ui.values[1] + 'K');
                $('.price-range-both').html('<i>K' + ui.values[0] + ' - </i>K' + ui.values[1]);

                // get values of min and max
                $("#minval").val(ui.values[0]);
                $("#maxval").val(ui.values[1]);

                if (ui.values[0] == ui.values[1]) {
                    $('.price-range-both i').css('display', 'none');
                } else {
                    $('.price-range-both i').css('display', 'inline');
                }

                if (collision($('.price-range-min'), $('.price-range-max')) == true) {
                    $('.price-range-min, .price-range-max').css('opacity', '0');
                    $('.price-range-both').css('display', 'block');
                } else {
                    $('.price-range-min, .price-range-max').css('opacity', '1');
                    $('.price-range-both').css('display', 'none');
                }

            }
        });

        $('.ui-slider-range').append('<span class="price-range-both value"><i>' + $('#slider').slider('values', 0) +
            ' - </i>' + $('#slider').slider('values', 1) + '</span>');

        $('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">' + $('#slider').slider('values', 0) +
            'k</span>');

        $('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">' + $('#slider').slider('values', 1) +
            'k</span>');
    </script>
@endsection