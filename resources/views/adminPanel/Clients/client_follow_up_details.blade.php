
<?php 
    use App\Helpers\Helper;
    use Carbon\Carbon;
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
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                            <li class="breadcrumb-item active">Profile 2</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Client Details</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-xl-4 col-lg-5">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img src="{{ asset('public\adminPanel\assets\images\profile.png') }}" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                        <h4 class="mb-0 mt-2">{{ $client_data->first_name ?? "" }} {{ $client_data->last_name ?? ''  }}</h4>
                                        <p class="text-muted font-14">{{ $client_data->client_profession ?? "" }}</p>
                                            <span  
                                                class="badge 
                                                <?php 
                                                    if($client_data->status == 'Open')
                                                        echo "bg-warning";
                                                    if($client_data->status == 'In Progress')
                                                        echo "bg-info";
                                                    if($client_data->status == 'Mature')
                                                        echo "bg-success";
                                                    if($client_data->status == 'Lost')
                                                        echo "bg-danger";
                                                    
                                                ?>
                                                "
                                            
                                            >{{ $client_data->status  }}
                                            </span>
                                        

                                       
                                        <div class="text-start mt-3">
                                            <h4 class="font-13 text-uppercase">About Client :</h4>
                                            
                                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">{{ $client_data->first_name ?? "" }} {{ $client_data->last_name ?? ''  }}</span></p>
                                            @if($client_data->dealer_name)
                                                <p class="text-muted mb-2 font-13"><strong>Dealer Name :</strong> <span class="ms-2">{{ $client_data->dealer_name ?? "" }}</span></p>
                                            @endif                                            
                                            <p class="text-muted mb-1 font-13"><strong>Type :</strong> <span class="ms-2">{{ $client_data->client_type ?? "" }}</span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Mobile Number:</strong><span class="ms-2">{{ $client_data->phone ?? "" }}</span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Other Mobile Number:</strong><span class="ms-2">{{ $client_data->other_phone ?? "" }}</span></p>

                                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 ">{{ $client_data->email ?? "" }}</span></p>

                                            <p class="text-muted mb-1 font-13"><strong>Country :</strong> <span class="ms-2">{{ $client_data->country ?? "" }}</span></p>
                                            <p class="text-muted mb-1 font-13"><strong>City :</strong> <span class="ms-2">{{ $client_data->city ?? "" }}</span></p>
                                            <p class="text-muted mb-1 font-13"><strong>Resource :</strong> <span class="ms-2">{{ $client_data->client_resource ?? "" }}</span></p>
                                            <p class="text-muted mb-1 font-13"><strong>Address :</strong> <span class="ms-2">{{ $client_data->client_address ?? "" }}</span></p>
                                        </div>

                                     
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->

                               

                            </div> <!-- end col-->

                            <div class="col-xl-8 col-lg-7">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="table-responsive">
                                            <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Follow Type</th>
                                                        <th>Reason</th>
                                                        <th>Comment</th>
                                                        <th>Follow Times</th>
                                                        <th>Follow By</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                  
                                                @isset($client_follow_up)
                                                        @foreach($client_follow_up as $client_res)
                                                       
                                                    <tr>
                                                        <td>
                                                            {{ $client_res->id }}
                                                        </td>
                                                       
                                                        <td>
                                                        <?php 
                                                            if(isset($client_res->sub_category_id)){
                                                                $subCategorydata = Helper::get_sub_category_name($client_res->sub_category_id);
                                                                echo  $subCategorydata->categoryOf->follow_up_name ?? '';
                                                                
                                                            }
                                                            
                                                        ?>
                                                        </td>
                                                        <td>
                                                            @if(isset($client_res->sub_category_id))
                                                                {{ $subCategorydata->follow_up_sub_category; }}
                                                            @endif
                                                        </td>
                                                        <td class="change_user">
                                                            {{ $client_res->follow_up_message; }}

                                                        </td>
                                                        
                                                        <td>
                                                        <?php 
                                                                    if(isset($client_res->created_at)){
                                                                        $formattedDatetime = Carbon::parse($client_res->created_at)->format('d-m-Y h:i:A');
                                                                        echo "Follow Up At: ".$formattedDatetime."<br>";
                                                                    }
                                                                        
                                                                    if(isset($client_res->next_follow_up_time)){
                                                                        $formattedDatetime = Carbon::parse($client_res->next_follow_up_time)->format('d-m-Y h:i:A');
                                                                        echo "Follow Up Next: ".$formattedDatetime;
                                                                    }
                                                                    
                                                                ?>
                                                        </td>
                                                        <td>
                                                            {{ Helper::getAgentName($client_res->follow_up_by) }}
                                                        </td>
                                                        
                                                    </tr>
                                                    
                                                    @endforeach
                                                @endisset

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

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

                