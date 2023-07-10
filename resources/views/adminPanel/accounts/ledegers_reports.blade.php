
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
                                    <h4 class="page-title">Ledgers Reports</h4>
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
                                                <h4 class="page-title">Ledgers Reports</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                <!-- <a href="{{ URL::to('payments-add') }}" class="btn btn-success" ><i class="mdi mdi-plus-circle me-2"></i>Add Payment</a> -->
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                                    <li class="nav-item">
                                                        <a href="#cash_ledeger" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Cash Account Ledger</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#date_wise_cash_ledeger" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Date wise Cash Account Ledger</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#agent_ledeger" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Agent Ledger</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#date_wise_agent_ledeger" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Date wise Agent Ledger</span>
                                                        </a>
                                                    </li>
                                                    
                  
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane show active" id="cash_ledeger">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12"><h5>Cash Account Ledeger</h5></div>
                                                                <div class="col-md-12">
                                                                    <form action="{{ URL::to('print-cash-account-ledeger') }}" target="blank" method="post">
                                                                    @csrf    
                                                                    <div class="row mt-3">
                                                                            <div class="col-md-10">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Account</label>
                                                                                <select class="form-control" name="account_id" id="">
                                                                                    @isset($CashAccountsdata)
                                                                                        @foreach($CashAccountsdata as $account_res)
                                                                                            <option value="{{ $account_res->id }}">{{ $account_res->account_name }}</option>
                                                                                        @endforeach
                                                                                    @endisset
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-2">
                                                                                <button type="submit" style="margin-top:1.8rem;" class="btn btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="date_wise_cash_ledeger">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12"><h5>Date Wise Cash Account Ledeger</h5></div>
                                                                <div class="col-md-12">
                                                                    <form action="{{ URL::to('date-wise-cash-account-ledeger') }}" target="blank" method="post">
                                                                    @csrf    
                                                                    <div class="row mt-3">
                                                                            <div class="col-md-4">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Account</label>
                                                                                <select class="form-control" name="account_id" id="">
                                                                                    @isset($CashAccountsdata)
                                                                                        @foreach($CashAccountsdata as $account_res)
                                                                                            <option value="{{ $account_res->id }}">{{ $account_res->account_name }}</option>
                                                                                        @endforeach
                                                                                    @endisset
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <label for="exampleInputEmail1" class="form-label">Start Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="start_date" id="">
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label for="example-input-normal" class="form-label">End Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="end_date" id="">

                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <button type="submit" style="margin-top:1.8rem;" class="btn btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="tab-pane" id="agent_ledeger">
                                                               
                                                        <div class="row">
                                                            <div class="col-md-12"><h5>Agent Ledeger</h5></div>
                                                                <div class="col-md-12">
                                                                    <form action="{{ URL::to('print-agent-account-ledeger') }}" target="blank" method="post">
                                                                    @csrf    
                                                                    <div class="row mt-3">
                                                                            <div class="col-md-10">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Account</label>
                                                                                <select class="form-control" name="agent_id" id="">
                                                                                    @isset($agentdata)
                                                                                        @foreach($agentdata as $agent_res)
                                                                                            <option value="{{ $agent_res->id }}">{{ $agent_res->fname." ".$agent_res->lname }}</option>
                                                                                        @endforeach
                                                                                    @endisset
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-2">
                                                                                <button type="submit" style="margin-top:1.8rem;" class="btn btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="date_wise_agent_ledeger">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12"><h5>Date Wise Agent Ledeger</h5></div>
                                                                <div class="col-md-12">
                                                                    <form action="{{ URL::to('date-wise-agent-account-ledeger') }}" target="blank" method="post">
                                                                    @csrf    
                                                                    <div class="row mt-3">
                                                                            <div class="col-md-4">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Agent</label>
                                                                                <select class="form-control" name="agent_id" id="">
                                                                                    @isset($agentdata)
                                                                                        @foreach($agentdata as $agent_res)
                                                                                            <option value="{{ $agent_res->id }}">{{ $agent_res->fname." ".$agent_res->lname }}</option>
                                                                                        @endforeach
                                                                                    @endisset
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <label for="exampleInputEmail1" class="form-label">Start Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="start_date" id="">
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label for="example-input-normal" class="form-label">End Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="end_date" id="">

                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <button type="submit" style="margin-top:1.8rem;" class="btn btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>                                                 
                                        
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>

               
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

                