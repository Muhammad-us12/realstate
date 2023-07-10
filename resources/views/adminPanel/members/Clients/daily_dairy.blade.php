<?php 
    use Carbon\Carbon;
    use App\Helpers\Helper;
    
    
?>
@extends('adminPanel/members/master')   
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
                                    <h4 class="page-title">Daily Dairy</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                            @if(session('success'))
                                <h1>Scuces</h1>
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

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-5">
                                                Daily Dairy
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('/client_registration') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add New Client</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-tabs mb-3">
                                                    <li class="nav-item">
                                                        <a href="#home" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Today Tasks
                                                            <span class="badge bg-info float-end" style="margin-left: 0.6rem;font-size: .8rem;">{{ count($today_follow_ups) }}</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#profile" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                            <span class="d-none d-md-block">Over Due 
                                                            <span class="badge bg-danger float-end" style="margin-left: 0.6rem;font-size: .8rem;">{{ count($pending_follow_ups) }}</span>
                                                            </span>
                                                            
                                                        </a>
                                                    </li>
                                                    
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane show active" id="home">
                                                        <div class="table-responsive">
                                                                <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Sr</th>
                                                                            <th>Type</th>
                                                                            <th>Client Name</th>
                                                                            <th>Phone</th>
                                                                            <th>Status</th>
                                                                            <th>Follow Time</th>
                                                                            <th>Reason</th>
                                                                            <th style="width: 85px;">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                    
                                                                    @isset($today_follow_ups)
                                                                    @foreach($today_follow_ups as $client_res)
                                                                        <?php 
                                                                            $follow_up_data = Helper::get_Client_follow_up($client_res->client_id);
                                                                            
                                                                        ?>
                                                                        <tr>
                                                                            <td>
                                                                                {{ $loop->iteration }}
                                                                            </td>
                                                                            <td>
                                                                                <?php 
                                                                                        if(isset($follow_up_data->sub_category_id)){
                                                                                            $subCategorydata = Helper::get_sub_category_name($follow_up_data->sub_category_id);
                                                                                            echo  $subCategorydata->categoryOf->follow_up_name ?? '';
                                                                                            
                                                                                        }
                                                                                       
                                                                                    ?>
                                                                            </td>
                                                                        
                                                                            <td>
                                                                            {{ $client_res->first_name." ".$client_res->last_name }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $client_res->phone }}
                                                                            </td>
                                                                            <td class="change_user">
                                                                                

                                                                                    <span   
                                                                                        class="badge 
                                                                                        <?php 
                                                                                        $currentDateTime = Carbon::now();
                                                                                            if($client_res->status == 'false' && $currentDateTime < $client_res->follow_up_time){
                                                                                                echo "bg-info";
                                                                                                $status = 'Not Followed Yet';
                                                                                            }else{
                                                                                                if($client_res->status == 'true'){
                                                                                                    echo "bg-success";
                                                                                                    $status = 'Followed';
                                                                                                }else{
                                                                                                    echo "bg-danger";
                                                                                                    $status = 'Not Followed Yet';
                                                                                                }
                                                                                                
                                                                                            } 
                                                                                                

                                                                                            
                                                                                        ?>
                                                                                        "
                                                                                    
                                                                                    >{{ $status  }}
                                                                                    </span>

                                                                            </td>
                                                                            <td>
                                                                                <?php 
                                                                                    $formattedDatetime = Carbon::parse($client_res->follow_up_time)->format('d-m-Y h:i:A');
                                                                                    echo $formattedDatetime;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            @if(isset($follow_up_data->sub_category_id))
                                                                            {{ $subCategorydata->follow_up_sub_category; }}
                                                                            @endif
                                                                            </td>
                                                                         
                                                                            

                                                                            <td class="table-action">
                                                                            
                                                                                <a href="{{ URL::to('client_follow_up/'.$client_res->id.'/'.$client_res->client_id.'') }}" title="Follow Up" class="btn btn-success btn-sm btn-outline"><i class="mdi mdi-sticker-check"></i></i></a>
                                                                                <a href="{{ URL::to('clients_follow_up_list/'.$client_res->client_id.'') }}" title="Follow Up Detials" class="btn btn-info btn-sm btn-outline"> <i class="mdi mdi-eye"></i></a>

                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        @endforeach
                                                                    @endisset

                                                                    </tbody>
                                                                </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane " id="profile">
                                                    <div class="table-responsive">
                                                                <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>Sr</th>
                                                                            <th>Type</th>
                                                                            <th>Client Name</th>
                                                                            <th>Phone</th>
                                                                            <th>Status</th>
                                                                            <th>Follow Time</th>
                                                                            <th>Reason</th>
                                                                            <th style="width: 85px;">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                    
                                                                    @isset($pending_follow_ups)
                                                                    @foreach($pending_follow_ups as $client_res)
                                                                        <?php 
                                                                            $follow_up_data = Helper::get_Client_follow_up($client_res->client_id);
                                                                            
                                                                        ?>
                                                                        <tr>
                                                                            <td>
                                                                                {{ $loop->iteration }}
                                                                            </td>
                                                                            <td>
                                                                            <?php 
                                                                                if(isset($follow_up_data->sub_category_id)){
                                                                                    $subCategorydata = Helper::get_sub_category_name($follow_up_data->sub_category_id);
                                                                                    echo  $subCategorydata->categoryOf->follow_up_name ?? '';
                                                                                    
                                                                                }
                                                                                    
                                                                                    ?>
                                                                            </td>
                                                                        
                                                                            <td>
                                                                            {{ $client_res->first_name." ".$client_res->last_name }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $client_res->phone }}
                                                                            </td>
                                                                            <td class="change_user">
                                                                                

                                                                                    <span   
                                                                                        class="badge 
                                                                                        <?php 
                                                                                        $currentDateTime = Carbon::now();
                                                                                            if($client_res->status == 'false' && $currentDateTime < $client_res->follow_up_time){
                                                                                                echo "bg-info";
                                                                                                $status = 'Not Followed Yet';
                                                                                            }else{
                                                                                                echo "bg-danger";
                                                                                                $status = 'Not Followed Yet';
                                                                                            } 
                                                                                                

                                                                                            if($client_res->status == 'true'){
                                                                                                echo "bg-success";
                                                                                                $status = 'Followed';
                                                                                            }
                                                                                           
                                                                                        ?>
                                                                                        "
                                                                                    
                                                                                    >{{ $status  }}
                                                                                    </span>

                                                                            </td>
                                                                            <td>
                                                                                <?php 
                                                                                    $formattedDatetime = Carbon::parse($client_res->follow_up_time)->format('d-m-Y h:i:A');
                                                                                    echo $formattedDatetime;
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            @if(isset($follow_up_data->sub_category_id))
                                                                            {{ $subCategorydata->follow_up_sub_category; }}
                                                                            @endif
                                                                            </td>
                                                                         
                                                                            

                                                                            <td class="table-action">
                                                                                <a href="{{ URL::to('client_follow_up/'.$client_res->id.'/'.$client_res->client_id.'') }}" title="Follow Up" class="btn btn-success btn-sm btn-outline"><i class="mdi mdi-sticker-check"></i></i></a>
                                                                                <a href="{{ URL::to('clients_follow_up_list/'.$client_res->client_id.'') }}" title="Follow Up Detials" class="btn btn-info btn-sm btn-outline"> <i class="mdi mdi-eye"></i></a>

                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        @endforeach
                                                                    @endisset

                                                                    </tbody>
                                                                </table>
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

                    <div id="update_agent_status" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-information h1 text-info"></i>
                                        <h4 class="mt-2">Are You Sure!</h4>
                                        <p class="mt-3">Are You Sure To Change Status.</p>
                                        
                                        <form action="{{ URL::to('update_agent_status') }}" method="post">
                                    @csrf
                                    <input type="text" class="form-control" hidden name="agent_id" id="agent_id" aria-describedby="emailHelp" placeholder="Enter Category">
                                    <input type="text" class="form-control" hidden name="agent_status" id="agent_status" aria-describedby="emailHelp" placeholder="Enter Category">

                                        <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Change</button>
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

                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
                console.log('page is load now');

                function updateUserStatus(id,status){
                    console.log('the id is '+id);
                    console.log('the status is '+status);
                    $('#agent_id').val('')
                    $('#agent_status').val('')
                    $('#agent_id').val(id)
                    $('#agent_status').val(status)

                    $('#update_agent_status').modal('show');
                }
            </script>         
         @endsection
                    <!-- container -->

                