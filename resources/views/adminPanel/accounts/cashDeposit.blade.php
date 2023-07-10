
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
                                    <h4 class="page-title">Accounts</h4>
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
                                                <h4 class="page-title">Cash Deposit List</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="mdi mdi-plus-circle me-2"></i>Add New</button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                        <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                      
                                                        <th>ID</th>
                                                        <th>Account Name</th>
                                                        <th>Deposit Amount</th>
                                                        <th>Deposit By</th>
                                                        <th>Investor Name</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($CashAccountDeposit)
                                                        @foreach($CashAccountDeposit as $deposit_res)
                                                    <tr>
                                                        <td>
                                                            {{ $deposit_res->id }}
                                                        </td>
                                                        <td>
                                                            {{ $deposit_res->AccountName->account_name }}
                                                        </td>
                                                        
                                                       
                                                        <td>
                                                            {{ number_format($deposit_res->deposit_amount) }}
                                                        </td>
                                                        <td>
                                                            {{ $deposit_res->deposit_by }}
                                                        </td>
                                                        <td>
                                                            {{ $deposit_res->insevter_name }}
                                                        </td>
                                                        

                                                                        
                                                        <td class="table-action">
                                                            <a href="{{ URL::to('cash_deposit_print/'.$deposit_res->id.'') }}" target="blank" class="action-icon"> <i class="dripicons-print"></i></a>
                                                          
                                                        </td>
                                                    </tr>
                                                        @endforeach
                                                    @endisset


                                                </tbody>
                                            </table>

                                            {!! $CashAccountDeposit->links() !!}
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
                                    <h4 class="modal-title" id="standard-modalLabel">Cash Deposit</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ URL::to('cash-deposit') }}" id="payment_from" method="post">
                                @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Select Account</label>
                                                <select class="form-select" name="account_id" id="example-select">
                                                @isset($CashAccountsdata)
                                                    @foreach($CashAccountsdata as $cash_res_data)
                                                    <option value="{{ $cash_res_data->id }}">{{ $cash_res_data->account_name }}</option>
                                                    @endforeach
                                                @endisset
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Deposit Amount</label>
                                                <input type="number" class="form-control" name="deposit_amount" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Deposit Amount">
                                                @error('deposit_amount')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Deposit By</label>
                                                <input type="text" name="deposit_by" class="form-control" id="exampleInputEmail1" name="deposit_by" aria-describedby="emailHelp" placeholder="Enter Deposit By">
                                                @error('deposit_by')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Invester Name</label>
                                                <input type="text" name="insevter_name" class="form-control" id="exampleInputEmail1" name="insevter_name" aria-describedby="emailHelp" placeholder="Enter Deposit By">
                                                @error('insevter_name')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                
                                    
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" onclick="disabledSubmitButton(this)" id="sub_pys" class="btn btn-success">Save changes</button>
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
                 var submit_form = true;
                function disabledSubmitButton(form) {
                    console.log(form);
                    console.log('Form is submit now ');
                    if(submit_form){
                        submit_form = false;
                        $('#payment_from').submit();
                    }
                    
                }

                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
            </script>            
         @endsection
                    <!-- container -->

                