
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
                                    <h4 class="page-title">Customers</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">

                                @if(session('success'))
                                    <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content modal-filled bg-success">
                                                <div class="modal-body p-4">
                                                    <div class="text-center">
                                                        <i class="dripicons-checkmark h1"></i>
                                                        <h4 class="mt-2">Well Done!</h4>
                                                        <p class="mt-3">{{ session('success') }}</p>
                                                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                    @endif

                                    @if(session('error'))
                                    <div id="error-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content modal-filled bg-danger">
                                                <div class="modal-body p-4">
                                                    <div class="text-center">
                                                        <i class="dripicons-wrong h1"></i>
                                                        <h4 class="mt-2">Oh snap!</h4>
                                                        <p class="mt-3">{{ session('error') }}</p>
                                                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    @endif

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-5">
                                                <h4>Add Customer</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('customers-list') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i>Customers List</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <form action="{{ URL::to('customer-update/'.$customerData->id.'') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">First Name</label>
                                                    <input type="text" id="example-input-normal" name="custfname" value="{{ $customerData->custfname }}" class="form-control" placeholder="First Name">
                                                    @error('custfname')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Last Name</label>
                                                    <input type="text" id="example-input-normal" name="custlname" value="{{ $customerData->custlname }}" class="form-control" placeholder="Last Name">
                                                    @error('custlname')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Opening Balance</label>
                                                    <input type="text" id="example-input-normal" name="balance" value="{{ old('balance') }}" class="form-control" placeholder="Last Name">
                                                    @error('balance')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div> -->

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">E mail</label>
                                                    <input type="email" id="example-input-normal" name="email" value="{{ $customerData->email }}" class="form-control" placeholder="email">
                                                    @error('email')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">CNIC</label>
                                                    <input type="text" id="example-input-normal" name="CNIC" value="{{ $customerData->CNIC }}" class="form-control" placeholder="Enter CNIC">
                                                    @error('CNIC')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                    <label for="example-input-normal" class="form-label">Customer Type</label>
                                                    <select class="form-control select2" name="customer_type" data-toggle="select2">
                                                        <option value="Customer" @if( $customerData->customer_type == 'Customer') selected @endif>Customer</option>
                                                        <option value="Property Dealer" @if($customerData->customer_type == 'Property Dealer') selected @endif>Property Dealer</option>
                                                          
                                                    </select>
                                            </div>

                                            

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-fileinput" class="form-label">Chose Picture</label>
                                                    <input type="file" id="example-fileinput" name="picture" class="form-control">
                                                    @error('picture')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <img src="{{ asset('/public/images/persons/'.$customerData->picture.'') }}" style="width:100px; height:100px" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />                                                           
                                            </div>
                                          
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select Country</label>
                                                    <select class="form-control select2" name="country" data-toggle="select2">
                                                           @foreach($countriesList as $county_res)
                                                            <option value="{{ $county_res->name }}" @if($county_res->name == $customerData->country) selected @endif>{{ $county_res->name }}</option>
                                                          
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select City</label>
                                                    <input type="text" id="example-input-normal" name="city" value="{{ $customerData->city }}" class="form-control" placeholder="Enter City">
                                                    @error('city')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Contact No.</label>
                                                    <input type="text" id="example-input-normal" name="phone" value="{{ $customerData->phone }}" class="form-control" placeholder="Contact No.">
                                                    @error('phone')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Address</label>
                                                    <input type="text" id="example-input-normal" name="address" value="{{ $customerData->address }}" class="form-control" placeholder="Enter Address">
                                                    @error('address')
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
         <script>
            @if(session('success'))
                        $(document).ready(function(){
                            $("#success-alert-modal").modal('show');
                        })  
                @endif

                @if(session('error'))
                    $(document).ready(function(){
                            $("#error-alert-modal").modal('show');
                    })
                @endif
         </script>
         @endsection
                    <!-- container -->

                