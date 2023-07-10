
<?php 
    use App\Helpers\Helper;
    use Carbon\Carbon;
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
                                    <h4 class="page-title">Clients</h4>
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
                                                Clients List
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('/client_registration') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add New Client</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Status</th>
                                                        <th>Follow Up</th>
                                                        <th>Follow Times</th>
                                                        <th>Country</th>
                                                        <th>City</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                  
                                                @isset($clients_list)
                                                        @foreach($clients_list as $client_res)
                                                        <?php 
                                                            $follow_up_data = Helper::get_Client_follow_up($client_res->id);
                                                            
                                                        ?>
                                                    <tr>
                                                        <td>
                                                            {{ $loop->iteration }}
                                                        </td>
                                                       
                                                        <td>
                                                        {{ $client_res->first_name." ".$client_res->last_name }}
                                                        </td>
                                                        <td>
                                                            {{ $client_res->phone }}
                                                        </td>
                                                        <td class="change_user">
                                                               

                                                                <span  onclick="updateUserStatus({{ $client_res->id }},'{{ $client_res->status }}')" 
                                                                    class="badge 
                                                                    <?php 
                                                                        if($client_res->status == 'Open')
                                                                            echo "bg-warning";
                                                                        if($client_res->status == 'In Progress')
                                                                            echo "bg-info";
                                                                        if($client_res->status == 'Mature')
                                                                            echo "bg-success";
                                                                        if($client_res->status == 'Lost')
                                                                            echo "bg-danger";
                                                                        
                                                                    ?>
                                                                    "
                                                                
                                                                >{{ $client_res->status  }}
                                                                </span>

                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if(isset($follow_up_data->sub_category_id)){
                                                                    $subCategorydata = Helper::get_sub_category_name($follow_up_data->sub_category_id);
                                                                    echo  $subCategorydata->follow_up_sub_category ?? '';
                                                                    
                                                                }
                                                                
                                                            ?>
                                                        </td>
                                                        <td>
                                                                <?php 
                                                                    if(isset($follow_up_data->created_at)){
                                                                        $formattedDatetime = Carbon::parse($follow_up_data->created_at)->format('d-m-Y h:i:A');
                                                                        echo "Follow Up At: ".$formattedDatetime."<br>";
                                                                    }
                                                                        
                                                                    if(isset($follow_up_data->next_follow_up_time)){
                                                                        $formattedDatetime = Carbon::parse($follow_up_data->next_follow_up_time)->format('d-m-Y h:i:A');
                                                                        echo "Follow Up Next: ".$formattedDatetime;
                                                                    }
                                                                    
                                                                ?>
                                                        </td>
                                                        
                                                        <td>
                                                            {{ $client_res->country }}
                                                        </td>
                                                        <td>
                                                            {{ $client_res->city }}
                                                        </td>
                                                        

                                                        <td class="table-action">
                                                        
                                                            <a href="{{ URL::to('clients_follow_up_list/'.$client_res->id.'') }}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                            <button class="btn btn-success btn-sm" onclick="udpate_cleint_status('{{ $client_res->id }}','{{ $client_res->status }}')">Update Status</button>
                                                            <a href="{{ URL::to('agent-update/'.$client_res->id.'') }}" class="action-icon text-success"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                        </td>
                                                    </tr>
                                                    
                                                    @endforeach
                                                @endisset

                                                </tbody>
                                            </table>
                                            {!! $clients_list->links() !!}
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

                    <div id="sub_cat_update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="standard-modalLabel">Update Client Status</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <form action="{{ URL::to('udpate_cleint_status') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                
                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Select Status</label>
                                        <select class="form-select" name="client_status" id="client_status">
                                            <option value="Open">Open</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Mature">Mature</option>
                                            <option value="Lost">Lost</option>
                                        </select>
                                    </div>
  
                                    <input type="text" hidden name="client_id" id="client_id">
                                
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

                function udpate_cleint_status(id,status){
                    console.log('id is '+id);
                    console.log('status is '+status);
                    $('#sub_cat_update').modal('show');
                    $('#client_status').val(status).change();
                    $('#client_id').val(id);
                }
            </script>         
         @endsection
                    <!-- container -->

                