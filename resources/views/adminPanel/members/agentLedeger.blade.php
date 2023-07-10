
         @extends('adminPanel/master')   
         @section('style')
            <link href="{{ asset('public/adminPanel/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
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
                                    <h4 class="page-title">Agent</h4>
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
                                                <h4 class="page-title">Agent Ledeger</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="mdi mdi-plus-circle me-2"></i>Add Account</button> -->
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table id="scroll-horizontal-datatable" class="table table-centered table-bordered w-100 nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                      
                                                        <th>ID</th>
                                                        <th>Payment</th>
                                                        <th>Recevied</th>
                                                        <th>Commission</th>
                                                        <th>Balance</th>
                                                        <th>Payment Id</th>
                                                        <th>Received Id</th>
                                                        <th>File Id</th>
                                                        <th>Property Id</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($CashAgentdata)
                                                        @foreach($CashAgentdata as $cash_res)
                                                            <tr>
                                                                <td>{{ $cash_res->id }}</td>
                                                                <td>{{ number_format($cash_res->payment) }}</td>
                                                                <td>{{ number_format($cash_res->received) }}</td>
                                                                <td>{{ number_format($cash_res->commission) }}</td>
                                                                <td>{{ number_format($cash_res->balance) }}</td>
                                                                <td>{{ $cash_res->payment_id }}</td>
                                                                <td>{{ $cash_res->recevied_id }}</td>
                                                                <td>{{ $cash_res->file_id }}</td>
                                                                <td>{{ $cash_res->property_id }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset


                                                </tbody>
                                            </table>

                                            {!! $CashAgentdata->links() !!}
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>

                    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="standard-modalLabel">Add Account</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ URL::to('account-submit') }}" method="post">
                                        @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Account Name</label>
                                        <input type="text" name="account_name" value="{{ old('account_name') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Account Name">
                                        @error('account_name')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Account Name</label>
                                        <input type="text" name="account_number" value="{{ old('account_number') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Account Number">
                                        @error('account_number')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Opening Balance</label>
                                        <input type="number" name="opening_bal" value="{{ old('opening_bal') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Opening Balance">
                                        @error('opening_bal')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save changes</button>
                                </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
         @endsection

         @section('scripts')
         <script src="{{ asset('public/adminPanel/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
         <script src="{{ asset('public/adminPanel/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
         
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

                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
            </script>            
         @endsection
                    <!-- container -->

                