
<?php 
 
                                    
     $agent_data = Auth::user()->img;
                           
                        
    function check_right1($rights){
        $user_rights = \Auth::user()->user_rights;
        
        $user_role = \Auth::user()->role;

        if($user_role == 'admin'){
            return true;
        }else{
            $user_rights = json_decode($user_rights);
            // print_r($user_rights);
            $result = '';
            foreach($user_rights as $right_res){
                if($rights == $right_res){
                    $result = true;
                }
            }
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
                        
?>
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
                                    <h4 class="page-title">Reports List</h4>
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
                                                <h4 class="page-title">Reports List</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="mdi mdi-plus-circle me-2"></i>Add Account</button> -->
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <div class="row">
                                        <div class="short_cuts" style="margin-top: 20px;">
                                                <?php 
                                                    if(check_right1('day_book')){
                                                ?>
                                                        <a href="{{ URL::to('day-book') }}" class="btn btn-info btn-sm">Day Book</a>
                                                <?php 
                                                    }
                                                    if(check_right1('Expense_report')){
                                                ?>
                                                        <a href="{{ URL::to('expense-reports') }}" class="btn btn-primary btn-sm">Expense Reports</a>
                                                <?php 
                                                    }
                                                    if(check_right1('pay_&_recv_report')){
                                                ?>
                                                        <a href="{{ URL::to('payments-report') }}" class="btn btn-success btn-sm">Payments & Recv Report</a>
                                            <?php 
                                                    }
                                                    if(check_right1('ledger_reports')){
                                                ?>
                                                        <a href="{{ URL::to('ledger-reports') }}" class="btn btn-danger btn-sm">Ledgers Reports</a>
                                            <?php 
                                                    }
                                                    if(check_right1('Files_reports')){
                                                ?>
                                                        <a href="{{ URL::to('files-reports') }}" class="btn btn-warning btn-sm">Files Reports</a>
                                            <?php 
                                                    }
                                                    if(check_right1('local_reports')){
                                                ?>
                                                        <a href="{{ URL::to('local-porperty-reports') }}" class="btn btn-secondary btn-sm">Property Reports</a>
                                            <?php 
                                                    }
                                                    if(check_right1('profit_report')){
                                                ?>
                                                <a href="{{ URL::to('profit-report') }}" class="btn btn-success btn-sm">Profit Report</a>
                                                <a href="{{ URL::to('date-wise-profit-report') }}" class="btn btn-success btn-sm">DateWise Profit Report</a>
                                                <?php
                                                    }
                                                ?>
                                            </div>
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

                