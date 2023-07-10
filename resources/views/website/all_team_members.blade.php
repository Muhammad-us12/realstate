
    <!-- header-end -->

    @extends('layouts.master')

@section('content')
    <!-- slider_area_start -->
    <div class="slider_area">
            <div class="single_slider single_slider2  d-flex align-items-center property_bg overlay2">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 offset-xl-1">
                                <div class="property_wrap">
                                        <div class="slider_text text-center justify-content-center">
                                                <h3>All Team Members</h3>
                                            </div>
                                            <div class="property_form">
                                            <form action="{{ URL::to('search-property') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form_wrap d-flex">
                                                        <div class="single-field max_width ">
                                                                <label for="#">Location</label>
                                                                <select class="form-control" onchange="fetchLocatonsSocities()" name="location" id="file_location">
                                                                        @isset($Location_data)
                                                                            @foreach($Location_data as $loca_res)
                                                                        <option value="{{ $loca_res->id }}">{{ $loca_res->location_name }}</option>
                                                                            @endforeach($Location_data)
                                                                        @endisset
                                                                        
                                                                </select>
                                                            </div>
                                                        <div class="single-field max_width ">
                                                                <label for="#">Select Society</label>
                                                                <select class="form-control" id="societies" name="society_id">
                                                                        
                                                                </select>
                                                            </div>
                                                            
                                                        <div class="single-field min_width ">
                                                            <label for="example-input-normal" class="form-label">Sate Type</label>
                                                            <select class="form-control" id="Propertytype" name="property_type" onchange="checkPropertyType()">
                                                                    <option value="Commerical">Commerical</option>
                                                                    <option value="Residentail">Residentail</option>
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
    </div>
    <!-- slider_area_end -->
    <div class="popular_property plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-40 text-center">
                        <h4>{{ $agents->total() }} Team Members </h4>
                    </div>
                </div>
            </div>
            <div class="row">
               
                @isset($agents)
                @foreach($agents as $agent_res)
                                <div class="col-xl-3 col-lg-3 col-md-6 mb-5">
                                    <div class="single_team">
                                        <div class="team_thumb">
                                            <img src="{{ asset('public/images/persons/'.$agent_res->picture.'') }}" style="width:100%;height:255px;" alt="">
                                            <div class="social_link d-none">
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
                                        <div class="team_info text-center m-3">
                                            <h3>{{ $agent_res->fname." ".$agent_res->lname }}</h3>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                @endisset
                
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                {!! $agents->links() !!}
                </div>
            </div>
           
        </div>
    </div>

    <!-- contact_action_area  -->
    <div class="contact_action_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-7">
                    <div class="action_heading">
                        <h3>Add your property for sale</h3>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="call_add_action">
                        <span>+10 637 367 4567</span>
                        <a href="#" class="boxed-btn3-line">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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