
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
                                    <h4 class="page-title">Users</h4>
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
                                                <h4>Add Users</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('/users-list') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i>Agents List</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">First Name</label>
                                                    <input type="text" id="example-input-normal" name="name" value="{{ old('name') }}" class="form-control" placeholder="First Name">
                                                    @error('name')
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
                                                    <label for="example-input-normal" class="form-label">E mail</label>
                                                    <input type="email" id="example-input-normal" name="email" value="{{ old('email') }}" class="form-control" placeholder="email">
                                                    @error('email')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Password</label>
                                                    <input type="password" id="example-input-normal" name="password" class="form-control" placeholder="Enter Password">
                                                    @error('password')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Password Confirmation</label>
                                                    <input type="password" id="example-input-normal" name="password_confirmation" class="form-control" placeholder="Re Enter Password">
                                                    @error('password_confirmation')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
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
                                            
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Blogs" id="customCheckcolor2" checked="">
                                                                <label class="form-check-label" for="customCheckcolor2">Blogs</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Videos" id="videos" checked="">
                                                                <label class="form-check-label" for="videos">Videos</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Offers" id="Offers" checked="">
                                                                <label class="form-check-label" for="Offers">Offers</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Locations" id="Locations" checked="">
                                                                <label class="form-check-label" for="Locations">Locations</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Scoieties" id="Scoieties" checked="">
                                                                <label class="form-check-label" for="Scoieties">Scoieties</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Files" id="Files" checked="">
                                                                <label class="form-check-label" for="Files">Files</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Files_post" id="post_files" checked="">
                                                                <label class="form-check-label" for="post_files">Post files</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Local Property" id="Local_Property" checked="">
                                                                <label class="form-check-label" for="Local_Property">Local Property</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Agents" id="Agent" checked="">
                                                                <label class="form-check-label" for="Agent">Agents</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Customer" id="Customer" checked="">
                                                                <label class="form-check-label" for="Customer">Customer</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Buyers" id="buyers" checked="">
                                                                <label class="form-check-label" for="buyers">Buyers</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Accounts" id="Accounts" checked="">
                                                                <label class="form-check-label" for="Accounts">Accounts</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Payments" id="Payments" checked="">
                                                                <label class="form-check-label" for="Payments">Payments</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Received" id="Received" checked="">
                                                                <label class="form-check-label" for="Received">Received</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="day_book" id="day_book" checked="">
                                                                <label class="form-check-label" for="day_book">Day Book</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Expense_report" id="Expense_report" checked="">
                                                                <label class="form-check-label" for="Expense_report">Expense Reports</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="pay_&_recv_report" id="pay_&_recv_report" checked="">
                                                                <label class="form-check-label" for="pay_&_recv_report">Payments & Rec Report</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="ledger_reports" id="ledger_reports" checked="">
                                                                <label class="form-check-label" for="ledger_reports">Ledgers Report</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="Files_reports" id="Files_reports" checked="">
                                                                <label class="form-check-label" for="Files_reports">Files Reports</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="local_reports" id="local_reports" checked="">
                                                                <label class="form-check-label" for="local_reports">Local Property</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        
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

                