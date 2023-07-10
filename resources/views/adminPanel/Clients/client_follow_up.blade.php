
@extends('adminPanel/members/master')   
         @section('style')
            <!-- Quill css -->
            <link href="{{ asset('public/adminPanel/assets/css/vendor/quill.bubble.css') }}" rel="stylesheet" type="text/css" />

            <link href="{{ asset('public/adminPanel/assets/css/vendor/quill.core.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/adminPanel/assets/css/vendor/quill.snow.css') }}" rel="stylesheet" type="text/css" />
         @endsection
         @section('content')        
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                       
                                    </div>
                                    <h4 class="page-title">Client Follow Up</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-5">
                                                <h4>Add Client Follow Up</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('/clients_list') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i>Clients List</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <form action="{{ URL::to('client_follow_up_sub') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Comment</label>
                                                    <textarea name="reanson" class="form-control" id="" cols="30" rows="5"></textarea>
                                                    @error('reanson')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                    <input type="text" hidden name="client_id" value="{{ $client_id }}">
                                                    <input type="text" hidden name="follow_up_id" value="{{ $follow_up_id }}">
                                                </div>
                                            </div>

                                            @foreach($allCategory as $cat_res)
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <hr>
                                                    <h4>{{ $cat_res->follow_up_name }}</h4>
                                                    
                                                    <div class="row">
                                                        @foreach($allSubCategory as $sub_cat_res)
                                                            @if($cat_res->id == $sub_cat_res->category_id)
                                                            <div class="col-sm-2">
                                                                <div class="mb-3">
                                                                        <div class="form-check form-radio-info mb-2">
                                                                            <input type="radio" id="{{ $sub_cat_res->id }}{{ $cat_res->id }}" value="{{ $sub_cat_res->id }}" name="follow_up_item" class="form-check-input" checked>
                                                                            <label class="form-check-label" for="{{ $sub_cat_res->id }}{{ $cat_res->id }}">{{ $sub_cat_res->follow_up_sub_category }}</label>
                                                                        </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            @endforeach


                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Next Follow Up</label>
                                                    <input type="datetime-local" class="form-control" name="next_follow_up">
                                                </div>
                                            </div>
                                           
                                            
                                           
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                     <button type="submit" class="btn btn-success mt-3" style="float:right;">Submit</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </form>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>
         @endsection

       
         @section('scripts')
         <script src="{{ asset('public/adminPanel/assets/js/vendor/quill.min.js') }}"></script>
         <script src="{{ asset('public/adminPanel/assets/js/pages/demo.quilljs.js') }}"></script>
           
         @endsection
                    <!-- container -->

                