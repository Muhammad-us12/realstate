
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
                                                <h4>Update User</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('/agents-list') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i>Agents List</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <form action="{{ URL::to('user-update/'.$agentData->id.'') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-2">
                                            <div class="col-sm-5">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">First Name</label>
                                                    <input type="text" id="example-input-normal" name="name" value="{{ $agentData->name }}" class="form-control" placeholder="First Name">
                                                    @error('name')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                          

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Status</label>
                                                    <select name="status" id="" class="form-control">
                                                        <option value="active" @if($agentData->status == 'active') selected @endif >Active</option>
                                                        <option value="block" @if($agentData->status == 'block') selected @endif>Block</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">E mail</label>
                                                    <input type="email" id="example-input-normal" readonly name="email" value="{{ $agentData->email }}" class="form-control" placeholder="email">
                                                    @error('email')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                          

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-fileinput" class="form-label">Chose Picture</label>
                                                    <input type="file" id="example-fileinput" name="picture" class="form-control">
                                                    @error('picture')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <img src="{{ asset('/public/images/persons/'.$agentData->img.'') }}" style="width:100px; height:100px" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />                                                           
                                            </div>
                                          
                                           

                                           
                                            
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Blogs',$agentData->id) }} value="Blogs" id="customCheckcolor2">
                                                                <label class="form-check-label" for="customCheckcolor2">Blogs</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Videos',$agentData->id) }} value="Videos" id="videos">
                                                                <label class="form-check-label" for="videos">Videos</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Offers',$agentData->id) }} value="Offers" id="Offers">
                                                                <label class="form-check-label" for="Offers">Offers</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Locations',$agentData->id) }} value="Locations" id="Locations">
                                                                <label class="form-check-label" for="Locations">Locations</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Scoieties',$agentData->id) }} value="Scoieties" id="Scoieties">
                                                                <label class="form-check-label" for="Scoieties">Scoieties</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3" style="margin-top:2rem;">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Files',$agentData->id) }} value="Files" id="Files">
                                                                <label class="form-check-label" for="Files">Files</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Users',$agentData->id) }} value="Users" id="Users">
                                                                <label class="form-check-label" for="Users">Users</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Files_post',$agentData->id) }} value="Files_post" id="post_files">
                                                                <label class="form-check-label" for="post_files">Post files</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Local Property',$agentData->id) }} value="Local Property" id="Local_Property">
                                                                <label class="form-check-label" for="Local_Property">Local Property</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Agents',$agentData->id) }} value="Agents" id="Agent">
                                                                <label class="form-check-label" for="Agent">Agents</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Customer',$agentData->id) }} value="Customer" id="Customer">
                                                                <label class="form-check-label" for="Customer">Customer</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Buyers',$agentData->id) }} value="Buyers" id="buyers">
                                                                <label class="form-check-label" for="buyers">Buyers</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Accounts',$agentData->id) }} value="Accounts" id="Accounts">
                                                                <label class="form-check-label" for="Accounts">Accounts</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Payments',$agentData->id) }} value="Payments" id="Payments">
                                                                <label class="form-check-label" for="Payments">Payments</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Received',$agentData->id) }} value="Received" id="Received">
                                                                <label class="form-check-label" for="Received">Received</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Expense',$agentData->id) }} value="Expense" id="Expense">
                                                                <label class="form-check-label" for="Expense">Expense</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" value="day_book" id="day_book" {{ Helper::check_user_rights('day_book',$agentData->id) }}>
                                                                <label class="form-check-label" for="day_book">Day Book</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Expense_report',$agentData->id) }} value="Expense_report" id="Expense_report" >
                                                                <label class="form-check-label" for="Expense_report">Expense Reports</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('pay_&_recv_report',$agentData->id) }} value="pay_&_recv_report" id="pay_&_recv_report" >
                                                                <label class="form-check-label" for="pay_&_recv_report">Payments & Rec Report</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('ledger_reports',$agentData->id) }} value="ledger_reports" id="ledger_reports" >
                                                                <label class="form-check-label" for="ledger_reports">Ledgers Report</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('Files_reports',$agentData->id) }} value="Files_reports" id="Files_reports" >
                                                                <label class="form-check-label" for="Files_reports">Files Reports</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <div class="form-check form-checkbox-success mb-2">
                                                                <input type="checkbox" class="form-check-input" name="agentRight[]" {{ Helper::check_user_rights('local_reports',$agentData->id) }} value="local_reports" id="local_reports" >
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

                