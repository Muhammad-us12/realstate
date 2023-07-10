
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
                                    <h4 class="page-title">Buyers</h4>
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
                                                <h4>Update Buyer</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('buyers-list') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i>Buyers List</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <form action="{{ URL::to('buyer-update/'.$buyerData->id.'') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">First Name</label>
                                                    <input type="text" id="example-input-normal" name="fname" value="{{ $buyerData->fname }}" class="form-control" placeholder="First Name">
                                                    @error('fname')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Last Name</label>
                                                    <input type="text" id="example-input-normal" name="lname" value="{{ $buyerData->lname }}" class="form-control" placeholder="Last Name">
                                                    @error('lname')
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
                                                    <input type="email" id="example-input-normal" name="email" value="{{ $buyerData->email }}" class="form-control" placeholder="email">
                                                    @error('email')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">CNIC</label>
                                                    <input type="text" id="example-input-normal" name="CNIC" value="{{ $buyerData->CNIC }}" class="form-control" placeholder="Enter CNIC">
                                                    @error('CNIC')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                    <label for="example-input-normal" class="form-label">Buyer Type</label>
                                                    <select class="form-control select2" name="buyer_type" data-toggle="select2">
                                                        <option value="Buyer" @if( $buyerData->buyer_type == 'Buyer') selected @endif>Customer</option>
                                                        <option value="Property Dealer" @if($buyerData->buyer_type == 'Property Dealer') selected @endif>Property Dealer</option>
                                                          
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
                                                <img src="{{ asset('/public/images/persons/'.$buyerData->picture.'') }}" style="width:100px; height:100px" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />                                                           
                                            </div>
                                          
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select Country</label>
                                                    <select class="form-control select2" name="country" data-toggle="select2">
                                                           @foreach($countriesList as $county_res)
                                                            <option value="{{ $county_res->name }}" @if($county_res->name == $buyerData->country) selected @endif>{{ $county_res->name }}</option>
                                                          
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select City</label>
                                                    <input type="text" id="example-input-normal" name="city" value="{{ $buyerData->city }}" class="form-control" placeholder="Enter City">
                                                    @error('city')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Contact No.</label>
                                                    <input type="text" id="example-input-normal" name="phone" value="{{ $buyerData->phone }}" class="form-control" placeholder="Contact No.">
                                                    @error('phone')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Address</label>
                                                    <input type="text" id="example-input-normal" name="address" value="{{ $buyerData->address }}" class="form-control" placeholder="Enter Address">
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

                