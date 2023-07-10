@extends('layouts.master')

@section('content')
    <!-- header-end -->

         <!-- bradcam_area  -->
        <div class="property_details_banner">
                <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-md-8 col-lg-6">
                                <div class="comfortable_apartment">
                                    <h4>{{ $soceity_data->society_name }}</h4>
                                    <p> <img src="img/svg_icon/location.svg" alt=""> {{ $soceity_data->SocietyLocation->location_name }}</p>
                                  
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-4 col-lg-6">
                              
                            </div>
                        </div>
                    </div>
        </div>
            <!--/ bradcam_area  -->

    <!-- details  -->
    <div class="property_details">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="property_banner">
                        <div class="property_banner_active owl-carousel">
                            <div class="single_property">
                                <img src="{{ asset('public/images/Societies/'.$soceity_data->picture.'') }}" alt="">
                            </div>
                            <div class="single_property">
                                <img src="{{ asset('public/images/Societies/'.$soceity_data->picture.'') }}" alt="">
                            </div>
                            <!--<div class="single_property">-->
                            <!--    <img src="{{ asset('public/websiteFrontend/img/banner/property_details.png') }}" alt="">-->
                            <!--</div>-->
                        </div>
                    </div>      
                </div>
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="details_info">
                        <h4>Description</h4>
                        {!! $soceity_data->description !!}

                    </div>
                    <section class="contact-section">
                    </section>
                    <div class="contact_field">
                        <h3>Contact Us</h3>
                        <form action="#">
                                <div class="row">
                                        <div class="col-xl-6 col-md-6">
                                            <input type="text" placeholder="Your Name" >
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <input type="email" placeholder="Email" >
                                        </div>
                                        <div class="col-xl-12">
                                            <input type="number" placeholder="Phone no." >
                                        </div>
                                        <div class="col-xl-12">
                                           <textarea name="" id="" cols="30" rows="10" placeholder="Message" ></textarea>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="send_btn">
                                                <button type="submit" class="send_btn">Send</button>
                                            </div>
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /details  -->

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
                        <a href="#" class="boxed-btn3-line">Add Property</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /contact_action_area  -->
@endsection