
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
                                    <h4 class="page-title">Files</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-5">
                                                Files List
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('add-files') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add New</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                      
                                                        <th>ID</th>
                                                        <th>Reg No.</th>
                                                        <th>Location</th>
                                                        <th>Society</th>
                                                        <th>Block</th>
                                                        <th>Purchase Amount</th>
                                                        <th>Purchase Date</th>
                                                        <th>Marla</th>
                                                        <th>State Type</th>
                                                        <th>Status</th>
                                                        <th>Purchase Post Status</th>
                                                        <th>Sale Post Status</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($files_data)
                                                        @foreach($files_data as $files_res)
                                                            <tr>
                                                                <td>
                                                                    {{ $files_res->id }}
                                                                </td>
                                                                <td>
                                                                    {{ $files_res->registration_no }}                                                           
                                                                </td>
                                                                <td>
                                                                    {{ $files_res->fileslocation->location_name }}
                                                                </td>
                                                                <td>
                                                                    {{ $files_res->filesSociety->society_name }}
                                                                </td>
                                                                <td>
                                                                    {{ $files_res->filesBlock->block_name }}
                                                                </td>
                                                                <td>
                                                                    {{ number_format($files_res->purchase_amount) }}
                                                                </td>
                                                                <td>
                                                                    {{ date('d-m-Y',strtotime($files_res->purchase_date)) }}
                                                                </td>
                                                                <td>
                                                                    {{ $files_res->filesMaral->marala }}
                                                                </td>
                                                                <td>
                                                                    {{ $files_res->state_type }}
                                                                    <input type="text" id="file_data{{ $files_res->id }}" hidden value='{{ json_encode($files_res) }}'>
                                                                </td>
                                                                <td>
                                                                @php
                                                                     if($files_res->status == 'pending' || $files_res->status == 'pending sale'){
                                                                        $isActive = false;
                                                                     }else{
                                                                        $isActive = true;
                                                                     }
                                                                
                                                                @endphp
                                                                    <span @class([
                                                                        'badge',
                                                                        'bg-success' => $isActive,
                                                                        'bg-danger' => ! $isActive,
                                                                    ])>{{ $files_res->status  }}</span> 
                                                                </td>
                                                                <td>
                                                                    @if(!$files_res->purc_post_status)
                                                                        @if(Helper::check_post_rights())
                                                                        <a href="javascript:void(0);" onclick="postPurchaseFile({{ $files_res->id }},{{ $files_res->account_id }})" class="action-icon text-success" title="Publish"> <i class="mdi mdi-checkbox-multiple-marked-outline"></i></a>
                                                                       @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                @if($files_res->status == 'sale' || $files_res->status == 'pending sale')
                                                                    @if(!$files_res->sale_post_status)
                                                                        @if(Helper::check_post_rights())
                                                                        <a href="javascript:void(0);" onclick="postSaleFile({{ $files_res->id }})" class="action-icon text-success" title="Publish"> <i class="mdi mdi-checkbox-multiple-marked-outline"></i></a>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                                </td>
                                                                <td class="table-action">
                                                                <a href="{{ URL::to('file-print/'.$files_res->id.'') }}" target="blank" class="btn btn-success btn-sm">View</a>
                                                                @if($files_res->status == 'Purchase')
                                                                    <!-- @if($files_res->status !== 'pending') -->
                                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" onclick="saleFile({{ $files_res->id }})" data-bs-target="#bs-example-modal-lg">Sale</button>    
                                                                    <!-- @endif -->
                                                                @endif

                                                                @if(!$files_res->purc_post_status)
                                                                    <?php 
                                                                        $user_role = \Auth::user()->role;
                                                                        if($user_role == 'admin'){
                                                                    ?>
                                                                    <a href="javascript:void(0);" onclick="updatePurchaseFile({{ $files_res->id }})" class="btn btn-info btn-sm" >Edit</a>
                                                                    <?php 
                                                                        }
                                                                    ?>
                                                                        
                                                                        
                                                                @endif
                                                                

                                                                @if($files_res->status == 'pending sale')
                                                                  <?php 
                                                                        $user_role = \Auth::user()->role;
                                                                        if($user_role == 'admin'){
                                                                    ?>
                                                                    <a href="javascript:void(0);" onclick="updateSaleFile({{ $files_res->id }})" class="btn btn-info btn-sm" >Edit</a>
                                                                    <?php 
                                                                        }
                                                                    ?>
                                                                        
                                                                        
                                                                @endif
                                                                    
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                </tbody>
                                            </table>
                                            {!! $files_data->links() !!}
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>


                    <!-- Large modal -->
                    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Sale File</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <form action="{{ URL::to('files-sale') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="card-body" id="placeholder_div">
                                            <h5 class="card-title placeholder-glow">
                                                <span class="placeholder col-6"></span>
                                            </h5>
                                            <p class="card-text placeholder-glow">
                                                <span class="placeholder col-7"></span>
                                                <span class="placeholder col-4"></span>
                                                <span class="placeholder col-4"></span>
                                                <span class="placeholder col-6"></span>
                                                <span class="placeholder col-8"></span>
                                            </p>
                                        </div>
                                        <div class="row mb-2" style="display:none;" id="form_div">
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">ID</label>
                                                    <input type="text" id="file_id"  readonly name="file_id" class="form-control" placeholder="Normal">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Registration No.</label>
                                                    <input type="text" id="registation_id" value="12393726216" readonly name="example-input-normal" class="form-control" placeholder="Normal">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Location</label>
                                                    <input type="text" id="location_name" value="Sheikhupura" readonly name="example-input-normal" class="form-control" placeholder="Normal">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Society</label>
                                                    <input type="text" id="scoiety_name" value="Al Jalil Garden" readonly name="example-input-normal" class="form-control" placeholder="Normal">
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Block</label>
                                                    <input type="text" id="block_name" value="C Block" readonly name="example-input-normal" class="form-control" placeholder="Normal">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-fileinput" class="form-label">Purchase Amount</label>
                                                    <input type="text" id="purchase_am" value="1,20,000" readonly name="example-input-normal" class="form-control" placeholder="Purchase Amount">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Purchase Date</label>
                                                    <input type="date" class="form-control date" value="12-12-2021" readonly id="purchase_date">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Marla</label>
                                                    <input type="text" class="form-control date" id="maral_id" value="5 Marla" readonly >
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Sate Type</label>
                                                    <input type="text" class="form-control date" id="state_type" value="Commerical" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Sold Date</label>
                                                    <input type="date" name="sold_date" class="form-control date">
                                                    @error('sold_date')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select Customer</label>
                                                    <select class="form-control select2" name="customer_id" data-toggle="select2">
                                                            @isset($Customers_data)
                                                                @foreach($Customers_data as $cust_res)
                                                                <option value="{{ $cust_res->id }}">{{ $cust_res->id }} \ {{ $cust_res->custfname." ".$cust_res->custlname }}</option>
                                                                @endforeach
                                                            @endisset
                                                        
                                                    </select>
                                                    @error('customer_id')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Sale Amount</label>
                                                    <input type="text" id="sale_am_sale" value="" name="sale_amount" class="form-control" placeholder="Sale Amount">
                                                    @error('sale_amount')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Agent Commission</label>
                                                    <input type="text" id="example-input-normal" value="" name="commission_amount" class="form-control" placeholder="Commission Amount">
                                                    @error('commission_amount')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Received Amount</label>
                                                    <input type="text" id="sale_am_recv" value="" name="recevied_amount" class="form-control" placeholder="Received Amount">
                                                    @error('recevied_amount')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Remaining Amount</label>
                                                    <input type="text" id="sale_am_remaning" readonly value="" name="remaining_amount" class="form-control" placeholder="Remaining Amount">
                                                    @error('remaining_amount')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select Agent</label>
                                                    <select class="form-control select2" name="agent_id" data-toggle="select2">
                                                        @isset($Agent_data)
                                                            @foreach($Agent_data as $agent_res)
                                                            <option value="{{ $agent_res->id }}">{{ $agent_res->id }} \ {{ $agent_res->fname." ".$cust_res->lname }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    @error('agent_id')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Receive Amount Account</label>
                                                    <select class="form-control select2" name="account_id_recv" data-toggle="select2">
                                                        @isset($CashAccounts_data)
                                                                @foreach($CashAccounts_data as $account_res)
                                                                <option value="{{ $account_res->id }}">{{ $account_res->account_name }} / {{ $account_res->account_number }}</option>
                                                                @endforeach
                                                        @endisset
                                                    </select>
                                                    @error('account_id_recv')
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
                                    </div>
                                </form>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div class="modal fade" id="update_purchase_file" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Update Purchase</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <form action="{{ URL::to('update_file_purchase') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                    
                                        <div class="row mb-2"  id="">
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">ID</label>
                                                    <input type="text" id="file_id_update"  readonly name="file_id" class="form-control" placeholder="Normal">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Registration No.</label>
                                                    <input type="text" id="registation_id_update" value="" name="registration_no" class="form-control" placeholder="Normal">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Location</label>
                                                    <select class="form-control" name="location_id" onchange="fetchLocatonsSocities()" id="file_location">
                                                            @isset($Location_data)
                                                                @foreach($Location_data as $location_res)
                                                                <option id="location_id{{ $location_res->id}}" value="{{ $location_res->id }}">{{ $location_res->location_name }}</option>
                                                                @endforeach
                                                            @endisset
                                                    </select>
                                                    @error('location_id')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Society</label>
                                                    <select class="form-control" id="societies_id_update" name="society_id" onchange="fetchSocitiesBlocks()" >
                                                                            
                                                    </select>
                                                    @error('society_id')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror 
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Block</label>
                                                    <select class="form-control" id="block_id_update" name="block_id">
                                                                            
                                                    </select>
                                                    @error('block_id')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror 
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-fileinput" class="form-label">Purchase Amount</label>
                                                    <input type="text" id="purchase_am_update" required  name="purchase_amount" class="form-control" placeholder="Purchase Amount">
                                                </div>
                                                @error('purchase_amount')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Purchase Date</label>
                                                    <input type="date" class="form-control date" name="purchase_date" required id="purchase_date_update">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Payment From</label>
                                                    <select class="form-control select2" id="account_id_update" name="account_id_update" data-toggle="select2">
                                                        @isset($CashAccounts_data)
                                                                @foreach($CashAccounts_data as $account_res)
                                                                <option value="{{ $account_res->id }}">{{ $account_res->account_name }} / {{ $account_res->account_number }}</option>
                                                                @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Marla</label>
                                                    <select class="form-control select2" name="marala_type" id="select_marala" data-toggle="select2">
                                                                                    
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Sate Type</label>
                                                    <select class="form-control select2" name="state_type" id="state_type_update" data-toggle="select2">
                                                            <option value="Commerical">Commerical</option>
                                                            <option value="Residentail">Residentail</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="example-textarea" class="form-label">Add Description</label>
                                                    <textarea id="summernote" name="description"></textarea>
                                                        
                                                </div>
                                            </div>

                                        

                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div class="modal fade" id="update_sale_file" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Update Sale </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <form action="{{ URL::to('update_file_sale') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                    
                                        <div class="row mb-2"  id="">
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">ID</label>
                                                    <input type="text" id="file_id_sale"  readonly name="file_id" class="form-control" placeholder="Normal">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Sold Date</label>
                                                    <input type="date" name="sold_date_sale" id="sold_date" class="form-control date">
                                                    @error('sold_date_sale')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select Customer</label>
                                                    <select class="form-control select2" name="customer_id" id="customer_id" data-toggle="select2">
                                                            @isset($Customers_data)
                                                                @foreach($Customers_data as $cust_res)
                                                                <option value="{{ $cust_res->id }}">{{ $cust_res->id }} \ {{ $cust_res->custfname." ".$cust_res->custlname }}</option>
                                                                @endforeach
                                                            @endisset
                                                        
                                                    </select>
                                                    @error('customer_id')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Sale Amount</label>
                                                    <input type="text" id="sale_amount" name="sale_amount" class="form-control" placeholder="Sale Amount">
                                                    @error('sale_amount')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Agent Commission</label>
                                                    <input type="text" id="agent_commission" name="commission_amount" class="form-control" placeholder="Commission Amount">
                                                    @error('commission_amount')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Received Amount</label>
                                                    <input type="text" id="received_amount" name="recevied_amount" class="form-control" placeholder="Purchase Amount">
                                                    @error('recevied_amount')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Remaining Amount</label>
                                                    <input type="text" id="remaing_amount" value="" readonly name="remaining_amount" class="form-control" placeholder="Purchase Amount">
                                                    @error('remaining_amount')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Select Agent</label>
                                                    <select class="form-control select2" id="agent_id" name="agent_id" data-toggle="select2">
                                                        @isset($Agent_data)
                                                            @foreach($Agent_data as $agent_res)
                                                            <option value="{{ $agent_res->id }}">{{ $agent_res->id }} \ {{ $agent_res->fname." ".$cust_res->lname }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    @error('agent_id')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="example-input-normal" class="form-label">Receive Amount Account</label>
                                                    <select class="form-control select2" id="account_id_recv" name="account_id_recv" data-toggle="select2">
                                                        @isset($CashAccounts_data)
                                                                @foreach($CashAccounts_data as $account_res)
                                                                <option value="{{ $account_res->id }}">{{ $account_res->account_name }} / {{ $account_res->account_number }}</option>
                                                                @endforeach
                                                        @endisset
                                                    </select>
                                                    @error('account_id_recv')
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
                                    </div>
                                </form>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-information h1 text-info"></i>
                                        <h4 class="mt-2">Are You Sure!</h4>
                                        <p class="mt-3">Are You Sure To Post This Purchase.</p>
                                        
                                        <form action="{{ URL::to('post_file_purchase') }}" method="post">
                                    @csrf
                                    <input type="text" class="form-control" hidden name="file_id" id="file_id_post" aria-describedby="emailHelp" placeholder="Enter Category">
                                    <input type="text" class="form-control" hidden  name="account_id" id="account_id" aria-describedby="emailHelp" placeholder="Enter Category">

                                        <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Publish</button>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <div id="standard-modal_sale" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-information h1 text-info"></i>
                                        <h4 class="mt-2">Are You Sure!</h4>
                                        <p class="mt-3">Are You Sure To Post This Sale.</p>
                                        
                                        <form action="{{ URL::to('post_file_sale') }}" method="post">
                                    @csrf
                                    <input type="text" class="form-control" hidden name="file_id" id="file_id_sale_post" aria-describedby="emailHelp" placeholder="Enter Category">

                                        <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Publish</button>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
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

                $('#summernote').summernote({
                        placeholder: 'Hello stand alone ui',
                        tabsize: 2,
                        height: 150,
                        toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });

                postPurchaseFile = (fileId,account_id)=>{
                    console.log('this is call now')
                    $("#standard-modal").modal('show');
                   
                    $('#file_id_post').val(fileId);
                    $('#account_id').val(account_id);
                    
                }

                fetchMaralaTypes = ()=>{
                    $.ajax({
                        url:"{{ URL::to('fetch_marala_type') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'marala':$('#marala').val()
                        },
                        success:function(data) {
                            let maralsHtml = ``;
                            data.forEach((marala)=>{
                                maralsHtml += `<option value="${marala['id']}">${marala['marala']}</option>`
                                
                            });

                            $('#select_marala').html(maralsHtml);
                        }
                    });
                }

                fetchMaralaTypes();

                postSaleFile = (fileId)=>{
                    $("#standard-modal_sale").modal('show');
                   
                    $('#file_id_sale_post').val(fileId);
                    
                }

                updateSaleFile = (fileId) => {
                    $("#update_sale_file").modal('show');
                    var fileData = $('#file_data'+fileId+'').val();
                    fileData = JSON.parse(fileData);
                    console.log(fileData);

                    $('#file_id_sale').val(fileData['id'])
                    $('#sold_date').val(fileData['sold_date'])
                    $('#customer_id').val(fileData['customer_id']).change();
                    $('#sale_amount').val(fileData['sale_amount'])
                    $('#agent_commission').val(fileData['commission_amount'])
                    $('#received_amount').val(fileData['recevied_amount'])
                    $('#remaing_amount').val(fileData['remaining_amount'])
                    $('#agent_id').val(fileData['agent_id']).change();
                    $('#account_id_recv').val(fileData['account_id_recv']).change();
                }

                updatePurchaseFile = (fileId)=>{
                    $("#update_purchase_file").modal('show');
                    var fileData = $('#file_data'+fileId+'').val();
                    fileData = JSON.parse(fileData);

                    var location_id = fileData['location_id'];
                    $('#location_id'+location_id+'').attr('selected','selected');

                    $.ajax({
                        url:"{{ URL::to('fetch_socities_wi_location') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'location_id':$('#file_location').val(),
                        },
                        success:function(data) {
                            console.log(data);
                            let socititesHtml = ``;
                            data.forEach((scoities)=>{
                                socititesHtml += `<option id="soc_${scoities['id']}" value="${scoities['id']}">${scoities['society_name']}</option>`
                                
                            });

                            $('#societies_id_update').html(socititesHtml);
                            var scoiety_id = fileData['society_id'];
                            $('#soc_'+scoiety_id+'').attr('selected','selected');

                            $.ajax({
                                url:"{{ URL::to('fetch_blocks_wi_scotites') }}",
                                type:'POST',
                                data:{
                                    '_token' : '<?php echo csrf_token() ?>',
                                    'scoitiy_id':scoiety_id,
                                },
                                success:function(data) {
                                    console.log(data);
                                    let blocksHtml = ``;
                                    data.forEach((blocks)=>{
                                        blocksHtml += `<option id="block_id_${blocks['id']}" value="${blocks['id']}">${blocks['block_name']}</option>`
                                        
                                    });

                                    $('#block_id_update').html(blocksHtml);
                                    var block_id = fileData['block_id'];
                                    $('#block_id_'+block_id+'').attr('selected','selected');
                                    
                                }
                            });
                            // fetchSocitiesBlocks(block_id);
                        }
                    });
                    // $('#file_location').val(fileData['location_id']).change();
                    // fetchLocatonsSocities(fileData['location_id'],fileData['location_id'],fileData['location_id']);
                    
                    $('#file_id_update').val(fileData['id']);
                    $('#registation_id_update').val(fileData['registration_no']);
                    $('#societies_id_update').val(fileData['society_id'])
                    $('#block_id_update').val(fileData['location_id']);
                    $('#purchase_am_update').val(fileData['purchase_amount']);
                    $('#purchase_date_update').val(fileData['purchase_date']);
                    $('#account_id_update').val(fileData['account_id']).change();
                    $('#select_marala').val(fileData['marala_type']).change();
                    $('#state_type_update').val(fileData['state_type']).change();
                    
                    $('#summernote').summernote("code", fileData['description']);
                    // console.log(fileData);
                    
                }

                fetchLocatonsSocities = (locationId,socitey_id,block_id)=>{
                    console.log('society exe');
                    $.ajax({
                        url:"{{ URL::to('fetch_socities_wi_location') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'location_id':$('#file_location').val(),
                        },
                        success:function(data) {
                            console.log(data);
                            let socititesHtml = ``;
                            data.forEach((scoities)=>{
                                socititesHtml += `<option id="soc_${scoities['id']}" value="${scoities['id']}">${scoities['society_name']}</option>`
                                
                            });

                            $('#societies_id_update').html(socititesHtml);

                            
                            // $('#societies_id_update').val(socitey_id).change();
                            fetchSocitiesBlocks(block_id);
                        }
                    });
                }


                calculageRemaningAm = ()=>{
                    var sale_amount = $('#sale_am_sale').val();
                    var sale_am_recv = $('#sale_am_recv').val();

                    var remaining_amount = sale_amount - sale_am_recv;
                    $('#sale_am_remaning').val(remaining_amount);
                }

                $('#sale_am_sale').on('keyup change',function(){
                    calculageRemaningAm();
                })

                $('#sale_am_recv').on('keyup change',function(){
                    calculageRemaningAm();
                })

                calculageRemaningAmUpdate = ()=>{
                    var sale_amount = $('#sale_amount').val();
                    var sale_am_recv = $('#received_amount').val();

                    var remaining_amount = sale_amount - sale_am_recv;
                    $('#remaing_amount').val(remaining_amount);
                }

                $('#sale_amount').on('keyup change',function(){
                    calculageRemaningAmUpdate();
                })

                $('#received_amount').on('keyup change',function(){
                    calculageRemaningAmUpdate();
                })



                fetchSocitiesBlocks = (block_id)=>{
                    console.log('block exe');
                    $.ajax({
                        url:"{{ URL::to('fetch_blocks_wi_scotites') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'scoitiy_id':$('#societies_id_update').val(),
                        },
                        success:function(data) {
                            console.log(data);
                            let blocksHtml = ``;
                            data.forEach((blocks)=>{
                                blocksHtml += `<option value="${blocks['id']}">${blocks['block_name']}</option>`
                                
                            });

                            $('#block_id_update').html(blocksHtml);
                            
                        }
                    });
                }

                

                saleFile = (id)=>{
                    // console.log('Thie id is '+id);
                    $('#placeholder_div').css('display','block');
                    $('#form_div').css('display','none');
                    $.ajax({
                        url:"{{ URL::to('fetch_file_wi_id') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'file_id':id
                        },
                        success:function(data) {
                            $('#placeholder_div').css('display','none');
                            $('#form_div').css('display','flex');

                            $('#file_id').val(data[0]['id'])
                            $('#registation_id').val(data[0]['registration_no'])
                            $('#location_name').val(data['location_name'])
                            $('#scoiety_name').val(data['society_name'])
                            $('#block_name').val(data['block_name'])
                            $('#maral_id').val(data['marala'])
                            $('#purchase_am').val(data[0]['purchase_amount'])
                            $('#purchase_date').val(data[0]['purchase_date'])
                            $('#state_type').val(data[0]['state_type'])
                        }
                    });
                }

                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
                console.log('page is load now');
            </script>         
         @endsection
                    <!-- container -->

                