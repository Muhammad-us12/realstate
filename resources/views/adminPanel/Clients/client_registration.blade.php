
@extends('adminPanel/master')   
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
                                    <h4 class="page-title">Clients</h4>
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
                                                <h4>Add Client</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('/all_clients_list') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i>Clients List</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <form action="{{ URL::to('client_registration_admin') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">First Name</label>
                                                    <input type="text" id="example-input-normal" name="fname" value="{{ old('fname') }}" class="form-control" placeholder="First Name">
                                                    @error('fname')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Last Name</label>
                                                    <input type="text" id="example-input-normal" name="lname" value="{{ old('lname') }}" class="form-control" placeholder="Last Name">
                                                    @error('lname')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Contact No.</label>
                                                    <input type="text" id="example-input-normal" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Contact No.">
                                                    @error('phone')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Other Contact No.</label>
                                                    <input type="text" id="example-input-normal" name="other_phone" value="{{ old('other_phone') }}" class="form-control" placeholder="Contact No.">
                                                    @error('other_phone')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">E mail</label>
                                                    <input type="text" id="example-input-normal" name="email" value="{{ old('email') }}" class="form-control" placeholder="E mail">
                                                    @error('email')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Profession</label>
                                                    <input type="text" id="example-input-normal" name="client_profession" value="{{ old('client_profession') }}" class="form-control" placeholder="Enter Profession">
                                                    @error('client_profession')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                          
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Client Type</label>
                                                    <select class="form-control select2" name="client_type" data-toggle="select2">
                                                        <option value="Dealer">Dealer</option>
                                                        <option value="Walk In">Walk In</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Dealer Name</label>
                                                    <input type="text" id="example-input-normal" name="dealer_name" value="{{ old('dealer_name') }}" class="form-control" placeholder="Enter Dealer Name">
                                                    @error('dealer_name')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Client Source</label>
                                                    <select class="form-control select2" name="client_resource" data-toggle="select2">
                                                        <option value="Personal Client">Personal Client</option>
                                                        <option value="UAN">UAN</option>
                                                        <option value="Walk-In">Walk-In</option>
                                                        <option value="Live Chat">Live Chat</option>
                                                        <option value="Event">Event</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select Country</label>
                                                    <select class="form-control select2" name="country" data-toggle="select2">
                                                           @foreach($countriesList as $county_res)
                                                            <option value="{{ $county_res->name }}" @if($county_res->name == 'PAKISTAN') selected @endif>{{ $county_res->name }}</option>
                                                          
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select City</label>
                                                    <input type="text" id="example-input-normal" name="city" value="{{ old('city') }}" class="form-control" placeholder="Enter City">
                                                    @error('city')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Address</label>
                                                    <input type="text" id="example-input-normal" name="client_address" value="{{ old('client_address') }}" class="form-control" placeholder="Enter client_address">
                                                    @error('client_address')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            
                                           
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                     <button type="submit" class="btn btn-success">Submit</button>
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

                