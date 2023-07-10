
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
                                    <h4 class="page-title">Property</h4>
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
                                                Property List
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add New Blog</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                      
                                                        <th>ID</th>
                                                        <th>Picture</th>
                                                        <th>Title</th>
                                                        <th>Location</th>
                                                        <th>Society</th>
                                                        <th>State Type</th>
                                                        <th>Property Type</th>
                                                        <th>Marla</th>
                                                        <th>Area</th>
                                                        <th>Road Size</th>
                                                        <th>Street Size</th>
                                                        <th>Customer Name</th>
                                                        <th>Owner Name</th>
                                                        <th>Demand Amount</th>
                                                        <th>Agent</th>
                                                        <th>Status</th>
                                                        <th>Sale Post Status</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @isset($property_data)
                                                        @foreach($property_data as $property_res)
                                                        <input type="text" id="property_data{{ $property_res->id }}" hidden value='{{ json_encode($property_res) }}'>
    
                                                    <tr>
                                                        <td>
                                                            {{ $property_res->id }}
                                                        </td>
                                                        <td>
                                                            <img src="public/images/Societies/{{ $property_res->img }}" style="width:100px; height:100px" alt="property-img" title="contact-img" class="rounded me-3" height="48" />
                                                        </td>
                                                        <td>
                                                            {{ $property_res->title }}
                                                        </td>
                                                        <td>
                                                            {{ $property_res->Propertylocation->location_name }}
                                                        </td>
                                                        <td>
                                                            {{ $property_res->PropertySociety->society_name }}
                                                        </td>
                                                        <td>
                                                             {{ $property_res->state_type }}
                                                        </td>
                                                        <td>
                                                            {{ $property_res->property_type }}
                                                        </td>
                                                        <td>
                                                            {{ $property_res->PropertyMaral->marala }}
                                                        </td>
                                                        <td>
                                                            {{ $property_res->area }}
                                                        </td>
                                                        <td>
                                                             {{ $property_res->road_size }}
                                                        </td>
                                                        <td>
                                                             {{ $property_res->street_size }}
                                                        </td>
                                                        <td>
                                                            {{ $property_res->PropertyCustomer->custfname." ".$property_res->PropertyCustomer->custlname }}
                                                        </td>
                                                        <td>
                                                             {{ $property_res->owner_name }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($property_res->demand_amount) }}
                                                        </td>
                                                        <td>
                                                            {{ $property_res->PropertyAgent->fname." ".$property_res->PropertyAgent->lname }}
                                                        </td>
                                                  
                                                        <td>
                                                                @php
                                                                     if($property_res->status == 'pending'){
                                                                        $isActive = false;
                                                                     }else{
                                                                        $isActive = true;
                                                                     }
                                                                
                                                                @endphp
                                                                    <span @class([
                                                                        'badge',
                                                                        'bg-success' => $isActive,
                                                                        'bg-danger' => ! $isActive,
                                                                    ])>{{ $property_res->status  }}</span> 
                                                                </td>
                                                               
                                                                <td>
                                                                @if($property_res->status == 'Pending sale')
                                                                    @if(!$property_res->sale_post_status)
                                                                        <a href="javascript:void(0);" onclick="postSaleFile({{ $property_res->id }})" class="action-icon text-success" title="Publish"> <i class="mdi mdi-checkbox-multiple-marked-outline"></i></a>
                                                                    @endif
                                                                @endif
                                                                </td>
                                                        <td class="table-action">
                                                            @if($property_res->status !== 'Pending sale' && $property_res->status !== 'sale')
                                                                <button class="btn btn-success btn-sm" onclick="saleProperty({{ $property_res->id }})" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-briefcase-check-outline"></i></button>    
                                                            @endif
                                                            @if($property_res->status == 'Pending sale')
                                                                <button class="btn btn-secondary btn-sm" onclick="saleProperty({{ $property_res->id }})" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-file-document-edit"></i></button>    
                                                            @endif
                                                            @if($property_res->status == 'pending')
                                                              <?php 
                                                                        $user_role = \Auth::user()->role;
                                                                        if($user_role == 'admin'){
                                                                    ?>
                                                                         <a href="{{ URL::to('property_update/'.$property_res->id.'') }}"  class="btn btn-outline-secondary btn-sm" ><i class="mdi mdi-file-document-edit"></i></a>
                                                                    <?php 
                                                                        }
                                                                    ?>
                                                                        
                                                                    
                                                                    
                                                            @endif
                                                            <a href="{{ URL::to('localproperty-print/'.$property_res->id.'') }}" target="blank" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a>    

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                 @endisset
                                                    
                                                    
                                                </tbody>
                                            </table>

                                            {!! $property_data->links() !!}
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
                <h4 class="modal-title" id="myLargeModalLabel">Sale Property</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
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
                    <form action="{{ URL::to('property-sale') }}" method="post">
                        @csrf
                        <div class="row mb-2" style="display:none;" id="form_div">
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">ID</label>
                                    <input type="text" id="property_id" value="1" readonly name="property_id" class="form-control" placeholder="Normal">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Location</label>
                                    <input type="text" id="pro_location" value="" readonly name="example-input-normal" class="form-control" placeholder="Normal">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Society</label>
                                    <input type="text" id="pro_scoiety" value="" readonly name="example-input-normal" class="form-control" placeholder="Normal">
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">State Type</label>
                                    <input type="text" id="state_type" value="Commerical" readonly name="example-input-normal" class="form-control" placeholder="Normal">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Property Type</label>
                                    <input type="text" id="property_type" value="" readonly name="example-input-normal" class="form-control" placeholder="Normal">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Marala</label>
                                    <input type="text" id="marala" value="" readonly name="example-input-normal" class="form-control" placeholder="Normal">
                                </div>
                            </div>

                            

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Area</label>
                                    <input type="text" id="area" value="3000" readonly name="example-input-normal" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Demand Amount</label>
                                    <input type="text" id="demand_amount" value="80,20,000" readonly name="example-input-normal" class="form-control" placeholder="Purchase Amount">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Customer Name</label>
                                    <input type="text" id="customer_name" class="form-control" value="Muhammad Ali" readonly >
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Owner Name</label>
                                    <input type="text" id="owner_name" class="form-control" value="Muhammad Ali" readonly >
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Agent Name</label>
                                    <input type="text" id="agent_name" class="form-control" value="Muhammad Aslam" readonly >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Sold Date</label>
                                    <input type="date" required name="sold_date" id="sold_date" class="form-control date">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Select Buyer</label>
                                    <select class="form-control select2" required id="buyer_id" name="buyer_id" data-toggle="select2">
                                        @isset($Buyers)
                                            @foreach($Buyers as $buyer_res)
                                            <option value="{{ $buyer_res->id }}">{{ $buyer_res->id }} / {{ $buyer_res->fname." ".$buyer_res->lname }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Sold Amount</label>
                                    <input type="number" id="sold_amount" required value="" name="sale_amount" class="form-control" placeholder="Sold Amount">
                                </div>
                            </div>

                            <!-- <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Remaining Amount</label>
                                    <input type="text" id="example-input-normal" value="" name="example-input-normal" class="form-control" placeholder="Purchase Amount">
                                </div>
                            </div> -->

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="commission_amount" class="form-label">Total Commission</label>
                                    <input type="text" id="total_commission_amount" value="" name="commission_amount" class="form-control" placeholder="Commission Received">
                                </div>
                            </div>

                            

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Commission Paid</label>
                                    <input type="text" id="commission_paid" value="" name="commission_paid" class="form-control" placeholder="Commission Paid">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Agent Commission</label>
                                    <input type="text" id="agent_commission" value="" name="agent_commission" class="form-control" placeholder="Commission Amount">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="commission_amount" class="form-label">Commission Received</label>
                                    <input type="text" id="commission_amount" readonly value="" name="commission_amount" class="form-control" placeholder="Commission Received">
                                </div>
                            </div>
                            

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Receive Account</label>
                                    <select class="form-control select2" id="account_id_recv" name="account_id_recv" data-toggle="select2">
                                        @isset($CashAccounts_data)
                                                @foreach($CashAccounts_data as $account_res)
                                                <option value="{{ $account_res->id }}">{{ $account_res->account_name }} / {{ $account_res->account_number }}</option>
                                                @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>

                        

                            <div class="col-sm-12">
                                <div class="mb-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                            
                        </div>
                    </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

                    <div id="standard-modal_sale" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-information h1 text-info"></i>
                                        <h4 class="mt-2">Are You Sure!</h4>
                                        <p class="mt-3">Are You Sure To Post This Sale.</p>
                                        
                                        <form action="{{ URL::to('post-property-sale') }}" method="post">
                                    @csrf
                                    <input type="text" class="form-control" hidden name="property_id" id="property_id_sale_post" aria-describedby="emailHelp" placeholder="Enter Category">

                                        <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">POST</button>
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
                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
                console.log('page is load now');

                $('#buyer_id').select2({
                    dropdownParent: $('#bs-example-modal-lg')
                });

                $('#account_id_recv').select2({
                    dropdownParent: $('#bs-example-modal-lg')
                });
                
                postSaleFile = (fileId)=>{
                    $("#standard-modal_sale").modal('show');
                   
                    $('#property_id_sale_post').val(fileId);
                    
                }

                calculateCommission = ()=>{
                    console.log('commission is call ');
                    var totalCommission = $('#total_commission_amount').val();
                    var commissionPaid = $('#commission_paid').val();
                    // var totalCommission = $('#agent_commission').val();

                    var remainingCommisson = totalCommission - commissionPaid;
                    $('#commission_amount').val(remainingCommisson);
                }

                $('#total_commission_amount').on('keyup change',function(){
                    calculateCommission();
                })

                $('#commission_paid').on('keyup change',function(){
                    calculateCommission();
                })

                saleProperty = (id)=>{
                    console.log('Thie id is '+id);
                    $('#placeholder_div').css('display','block');
                    $('#form_div').css('display','none');
                    $.ajax({
                        url:"{{ URL::to('fetch_proporty_wi_id') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'property_id':id
                        },
                        success:function(data) {
                            console.log(data);
                            $('#placeholder_div').css('display','none');
                            $('#form_div').css('display','flex');

                            $('#property_id').val(data[0]['id'])
                            $('#state_type').val(data[0]['state_type'])
                            $('#pro_scoiety').val(data['society_name'])
                            $('#pro_location').val(data['location_name'])
                            $('#property_type').val(data[0]['property_type'])
                            
                            if(data[0]['state_type'] == 'Commerical'){
                                $('#area').val(data[0]['area'])
                                $('#marala').val('')

                            }else{
                                $('#marala').val(data['marala'])
                                $('#area').val('')
                            }
                            
                            
                            
                            $('#demand_amount').val(data[0]['demand_amount'])
                            $('#owner_name').val(data[0]['owner_name'])
                            $('#customer_name').val(data['customer_name'])
                            $('#agent_name').val(data['agent_name'])

                            // Sale Data

                            if(data[0]['status'] == 'Pending sale'){
                                $('#myLargeModalLabel').html('Update Sale')
                                $('#account_id_recv').val(data[0]['account_id_recv']).change();
                                $('#buyer_id').val(data[0]['buyer_id']).change();
                                $('#agent_commission').val(data[0]['agent_commission'])
                                $('#commission_paid').val(data[0]['commission_paid'])
                                $('#commission_amount').val(data[0]['commission_amount'])
                                $('#sold_amount').val(data[0]['sale_amount'])
                                $('#sold_date').val(data[0]['sold_date'])
                            }else{
                                $('#myLargeModalLabel').html('Sale Property')
                                $('#agent_commission').val('')
                                $('#commission_paid').val('')
                                $('#commission_amount').val('')
                                $('#sold_amount').val('')
                                $('#sold_date').val('')
                            }
                            
                        }
                    });
                }

                updatePurchaseProperty = (propertyId)=>{
                    $("#update_purchase_file").modal('show');
                    var propertyData = $('#property_data'+propertyId+'').val();
                    propertyData = JSON.parse(propertyData);

                    print_r(propertyData);
                    // var location_id = fileData['location_id'];
                    // $('#location_id'+location_id+'').attr('selected','selected');

                    // $.ajax({
                    //     url:"{{ URL::to('fetch_socities_wi_location') }}",
                    //     type:'POST',
                    //     data:{
                    //         '_token' : '<?php echo csrf_token() ?>',
                    //         'location_id':$('#file_location').val(),
                    //     },
                    //     success:function(data) {
                    //         console.log(data);
                    //         let socititesHtml = ``;
                    //         data.forEach((scoities)=>{
                    //             socititesHtml += `<option id="soc_${scoities['id']}" value="${scoities['id']}">${scoities['society_name']}</option>`
                                
                    //         });

                    //         $('#societies_id_update').html(socititesHtml);
                    //         var scoiety_id = fileData['society_id'];
                    //         $('#soc_'+scoiety_id+'').attr('selected','selected');

                    //         $.ajax({
                    //             url:"{{ URL::to('fetch_blocks_wi_scotites') }}",
                    //             type:'POST',
                    //             data:{
                    //                 '_token' : '<?php echo csrf_token() ?>',
                    //                 'scoitiy_id':scoiety_id,
                    //             },
                    //             success:function(data) {
                    //                 console.log(data);
                    //                 let blocksHtml = ``;
                    //                 data.forEach((blocks)=>{
                    //                     blocksHtml += `<option id="block_id_${blocks['id']}" value="${blocks['id']}">${blocks['block_name']}</option>`
                                        
                    //                 });

                    //                 $('#block_id_update').html(blocksHtml);
                    //                 var block_id = fileData['block_id'];
                    //                 $('#block_id_'+block_id+'').attr('selected','selected');
                                    
                    //             }
                    //         });
                    //         // fetchSocitiesBlocks(block_id);
                    //     }
                    // });
                    // // $('#file_location').val(fileData['location_id']).change();
                    // // fetchLocatonsSocities(fileData['location_id'],fileData['location_id'],fileData['location_id']);
                    
                    // $('#file_id_update').val(fileData['id']);
                    // $('#registation_id_update').val(fileData['registration_no']);
                    // $('#societies_id_update').val(fileData['society_id'])
                    // $('#block_id_update').val(fileData['location_id']);
                    // $('#purchase_am_update').val(fileData['purchase_amount']);
                    // $('#purchase_date_update').val(fileData['purchase_date']);
                    // $('#account_id_update').val(fileData['account_id']).change();
                    // $('#select_marala').val(fileData['marala_type']).change();
                    // $('#state_type_update').val(fileData['state_type']).change();
                    
                    // $('#summernote').summernote("code", fileData['description']);
                    // console.log(fileData);
                    
                }

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

                