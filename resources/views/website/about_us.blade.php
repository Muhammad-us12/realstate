@extends('layouts.master')

@section('content')
<div class="bradcam_area bradcam_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="bradcam_text text-center">
                                <h3>About Us</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about_mission">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-md-6">
                            <div class="about_thumb">
                                <img src="{{ asset('public/websiteFrontend/img/about/about.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="about_text">
                                <h4>Our Mission</h4>
                                <p>While there are countless Trips out there in charity shops and car boot sales, you can also buy refurbished examples, with today replacement leatherette available in all colors. I love my Trip and use it regularly something so refreshing about its simplicity.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

            <div class="team_area">
            <div class="container">
                    <div class="row">
                            <div class="col-xl-12">
                                <div class="section_title mb-40 text-center">
                                    <h3>
                                            Our Agents
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
            </div>
        </div>
@endsection