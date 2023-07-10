
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
                                    <h4 class="page-title">Local Property Reports</h4>
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
                                                <h4 class="page-title">Local Property Reports</h4>
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
                                                        <a href="#status_wise_file" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Status Wise</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#date_wise_cash_ledeger" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Location Wise</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#society_wise_files" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Society Wise</span>
                                                        </a>
                                                    </li>
                                                  
                                                    <li class="nav-item">
                                                        <a href="#marala_wise_file" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Marala Wise</span>
                                                        </a>
                                                    </li>
                                                   
                                                    <!-- <li class="nav-item">
                                                        <a href="#sale_date_wise" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Sale Date Wise</span>
                                                        </a>
                                                    </li> -->
                                                    
                  
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane show active" id="status_wise_file">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12"><h5>Satus Wise Property Report</h5></div>
                                                                <div class="col-md-12">
                                                                    <form action="{{ URL::to('status-wise-property') }}" target="blank" method="post">
                                                                    @csrf    
                                                                    <div class="row mt-3">
                                                                            <div class="col-md-6">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Status</label>
                                                                                <select class="form-control" name="status" id="">
                                                                                    <option value="1">All Status</option>
                                                                                    <option value="pending">Pending</option>
                                                                                    <option value="Pending sale">Pending Sale</option>
                                                                                    <option value="sale">Sale</option>
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-2">
                                                                                <label for="example-input-normal" class="form-label">Sate Type</label>
                                                                                <select class="form-select" id="Propertytype" name="property_type" onchange="checkPropertyType()">
                                                                                        <option value="1">All Types</option>
                                                                                        <option value="Commerical">Commerical</option>
                                                                                        <option value="Residentail">Residentail</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <label for="example-input-normal" class="form-label">Property Type</label>
                                                                                <select class="form-select" name="property_type_comm">
                                                                                        <option value="1">All Types</option>
                                                                                        <option value="Plot">Plot</option>
                                                                                        <option value="Plaza">Plaza</option>
                                                                                        <option value="Shop">Shop</option>
                                                                                        <option value="House">House</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 mt-2">
                                                                                <label for="exampleInputEmail1" class="form-label">Start Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="start_date" id="">
                                                                            </div>
                                                                            <div class="col-md-4 mt-2">
                                                                                <label for="example-input-normal" class="form-label">End Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="end_date" id="">

                                                                            </div>
                                                                            <div class="col-md-2 mt-2">
                                                                                <button type="submit" style="margin-top:1.8rem;" class="btn form-control btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="date_wise_cash_ledeger">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12"><h5>Location Wise Property Reports</h5></div>
                                                                <div class="col-md-12">
                                                                <form action="{{ URL::to('location-wise-property') }}" target="blank" method="post">
                                                                    @csrf    
                                                                    <div class="row mt-3">
                                                                            <div class="col-md-3">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Location</label>
                                                                                <select class="form-control" name="location" id="">
                                                                                    @isset($Location_data)
                                                                                        @foreach($Location_data as $location_res)
                                                                                            <option value="{{ $location_res->id }}">{{ $location_res->location_name }}</option>
                                                                                        @endforeach
                                                                                    @endisset
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Status</label>
                                                                                <select class="form-control" name="status" id="">
                                                                                    <option value="1">All Status</option>
                                                                                    <option value="pending">Pending</option>
                                                                                    <option value="Pending sale">Pending Sale</option>
                                                                                    <option value="sale">Sale</option>
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-2">
                                                                                <label for="example-input-normal" class="form-label">Sate Type</label>
                                                                                <select class="form-select" id="Propertytype" name="property_type" onchange="checkPropertyType()">
                                                                                        <option value="1">All Types</option>
                                                                                        <option value="Commerical">Commerical</option>
                                                                                        <option value="Residentail">Residentail</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <label for="example-input-normal" class="form-label">Property Type</label>
                                                                                <select class="form-select" name="property_type_comm">
                                                                                        <option value="1">All Types</option>
                                                                                        <option value="Plot">Plot</option>
                                                                                        <option value="Plaza">Plaza</option>
                                                                                        <option value="Shop">Shop</option>
                                                                                        <option value="House">House</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 mt-2">
                                                                                <label for="exampleInputEmail1" class="form-label">Start Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="start_date" id="">
                                                                            </div>
                                                                            <div class="col-md-4 mt-2">
                                                                                <label for="example-input-normal" class="form-label">End Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="end_date" id="">

                                                                            </div>
                                                                            <div class="col-md-2 mt-2">
                                                                                <button type="submit" style="margin-top:1.8rem;" class="btn form-control btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    
                                                                </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="tab-pane" id="society_wise_files">
                                                               
                                                        <div class="row">
                                                            <div class="col-md-12"><h5>Societies Wise Files</h5></div>
                                                                <div class="col-md-12">
                                                                    <form action="{{ URL::to('societies-wise-property') }}" target="blank" method="post">
                                                                    @csrf    
                                                                    <div class="row mt-3">
                                                                            
                                                                        <div class="col-sm-3">
                                                                            <div class="mb-3">
                                                                                <label for="example-input-normal" class="form-label">Select Location</label>
                                                                                <select class="form-control select2" name="location_id" onchange="fetchLocatonsSocities('file_location1','societies')" id="file_location1" data-toggle="select2">
                                                                                    @isset($Location_data)
                                                                                        @foreach($Location_data as $location_res)
                                                                                        <option value="{{ $location_res->id }}">{{ $location_res->location_name }}</option>
                                                                                        @endforeach
                                                                                    @endisset
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-3">
                                                                            <div class="mb-3">
                                                                                <label for="example-input-normal" class="form-label">Select Society</label>
                                                                                <select class="form-control select2" id="societies" name="society_id" onchange="fetchSocitiesBlocks()" data-toggle="select2">
                                                                                
                                                                                </select>
                                                                                @error('society_id')
                                                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                                                @enderror 
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Status</label>
                                                                                <select class="form-control" name="status" id="">
                                                                                    <option value="1">All Status</option>
                                                                                    <option value="pending">Pending</option>
                                                                                    <option value="Pending sale">Pending Sale</option>
                                                                                    <option value="sale">Sale</option>
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-2">
                                                                                <label for="example-input-normal" class="form-label">Sate Type</label>
                                                                                <select class="form-select" id="Propertytype" name="property_type" onchange="checkPropertyType()">
                                                                                        <option value="1">All Types</option>
                                                                                        <option value="Commerical">Commerical</option>
                                                                                        <option value="Residentail">Residentail</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-2 mt-2">
                                                                                <label for="example-input-normal" class="form-label">Property Type</label>
                                                                                <select class="form-select" name="property_type_comm">
                                                                                        <option value="1">All Types</option>
                                                                                        <option value="Plot">Plot</option>
                                                                                        <option value="Plaza">Plaza</option>
                                                                                        <option value="Shop">Shop</option>
                                                                                        <option value="House">House</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 mt-2">
                                                                                <label for="exampleInputEmail1" class="form-label">Start Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="start_date" id="">
                                                                            </div>
                                                                            <div class="col-md-4 mt-2">
                                                                                <label for="example-input-normal" class="form-label">End Date</label>
                                                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="end_date" id="">

                                                                            </div>
                                                                       
                                                                            
                                                                            <div class="col-md-2 mt-2">
                                                                                <button type="submit" style="margin-top:1.8rem;" class="btn btn-success">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="tab-pane" id="marala_wise_file">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12"><h5>Marala Wise Files Report</h5></div>
                                                                <div class="col-md-12">
                                                                    <form action="{{ URL::to('marala-wise-property') }}" target="blank" method="post">
                                                                    @csrf    
                                                                    <div class="row mt-3">
                                                                    
                                                                        <div class="col-md-5">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Marala</label>
                                                                                <select class="form-control" name="marala" id="">
                                                                                    @isset($marala)
                                                                                        @foreach($marala as $marala_res)
                                                                                            <option value='{{ json_encode($marala_res) }}'>{{ $marala_res->marala }}</option>
                                                                                        @endforeach
                                                                                    @endisset
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-md-5">
                                                                                <label for="exampleInputEmail1" class="form-label">Select Status</label>
                                                                                <select class="form-control" name="status" id="">
                                                                                    <option value="1">All Status</option>
                                                                                    <option value="pending">Pending</option>
                                                                                    <option value="pending sale">Pending Sale</option>
                                                                                    <option value="sale">Sale</option>
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

                    fetchLocatonsSocities = (id,societies)=>{
                        $.ajax({
                            url:"{{ URL::to('fetch_socities_wi_location') }}",
                            type:'POST',
                            data:{
                                '_token' : '<?php echo csrf_token() ?>',
                                'location_id':$('#'+id+'').val()
                            },
                            success:function(data) {
                                console.log(data);
                                let socititesHtml = ``;
                                data.forEach((scoities)=>{
                                    socititesHtml += `<option value="${scoities['id']}">${scoities['society_name']}</option>`
                                    
                                });

                                $('#'+societies+'').html(socititesHtml);
                                fetchSocitiesBlocks();
                            }
                        });
                    }

                    fetchLocatonsSocities('file_location1','societies');
                    fetchLocatonsSocities('file_location2','societies_id');

                fetchSocitiesBlocks = ()=>{
                    $.ajax({
                        url:"{{ URL::to('fetch_blocks_wi_scotites') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'scoitiy_id':$('#societies_id').val()
                        },
                        success:function(data) {
                            console.log(data);
                            let blocksHtml = ``;
                            data.forEach((blocks)=>{
                                blocksHtml += `<option value="${blocks['id']}">${blocks['block_name']}</option>`
                                
                            });

                            $('#block').html(blocksHtml);
                        }
                    });
                }

                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
                
        
            
            </script>            
         @endsection
                    <!-- container -->

                