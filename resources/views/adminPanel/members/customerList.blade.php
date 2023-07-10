
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

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-5">
                                                Customer List
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('/add-customer') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add New Customer</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Picture</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Opening Balance</th>
                                                        <th>Balance</th>
                                                        <th>Type</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @isset($customerData)
                                                        @foreach($customerData as $cust_res)
                                                    <tr>
                                                        <td>
                                                            {{ $cust_res->id }}
                                                        </td>
                                                        <td>
                                                            <img src="public/images/persons/{{ $cust_res->picture }}" style="width:100px; height:100px" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />                                                           
                                                        </td>
                                                       
                                                        <td>
                                                        {{ $cust_res->custfname." ".$cust_res->custlname }}
                                                        </td>
                                                        <td>
                                                            {{ $cust_res->email }}
                                                        </td>
                                                        
                                                        <td>
                                                            {{ number_format($cust_res->opening_bal) }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($cust_res->CustomerBalance->balance) }}
                                                        </td>
                                                        <td>
                                                                @php
                                                                     if($cust_res->customer_type !== 'Customer'){
                                                                        $isActive = false;
                                                                     }else{
                                                                        $isActive = true;
                                                                     }
                                                                
                                                                @endphp
                                                                <span @class([
                                                                        'badge',
                                                                        'bg-success' => $isActive,
                                                                        'bg-info' => ! $isActive,
                                                                    ])>{{ $cust_res->customer_type  }}
                                                                </span>

                                                        </td>
                                                        <td class="table-action">
                                                        
                                                            <a href="{{ URL::to('customer-ledeger/'.$cust_res->id.'') }}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                            <a href="{{ URL::to('agents-profile/1') }}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                             <?php 
                                                                        $user_role = \Auth::user()->role;
                                                                        if($user_role == 'admin'){
                                                                    ?>
                                                                        <a href="{{ URL::to('customer-update/'.$cust_res->id.'') }}" class="action-icon text-success"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                                    <?php 
                                                                        }
                                                                    ?>
                                                            
                                                        </td>
                                                    </tr>
                                                    
                                                    @endforeach
                                                @endisset

                                                </tbody>
                                            </table>
                                            {!! $customerData->links() !!}
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
                console.log('page is load now');
            </script>         
         @endsection
                    <!-- container -->

                