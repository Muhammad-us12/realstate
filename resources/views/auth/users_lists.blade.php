
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
                                    <h4 class="page-title">Agents</h4>
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
                                                Users List
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('/add-agent') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add New Agent</a>
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
                                                        <th>Display on web</th>
                                                        <th>Status</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @isset($users)
                                                    @foreach($users as $admin_res)
                                                    <tr>
                                                        <td>
                                                            {{ $admin_res->id }}
                                                        </td>
                                                        <td>
                                                            <img src="public/images/persons/{{ $admin_res->img }}" style="width:100px; height:100px" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />                                                           
                                                        </td>
                                                       
                                                        <td>
                                                        {{ $admin_res->name }}
                                                        </td>
                                                        <td>
                                                            {{ $admin_res->email }}
                                                        </td>
                                                        <td>
                                                          
                                                             @if($admin_res->display_on_web)
                                                                {{ "Yes" }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                             @php
                                                                     if($admin_res->status !== 'active'){
                                                                        $isActive = false;
                                                                     }else{
                                                                        $isActive = true;
                                                                     }
                                                                
                                                                @endphp
                                                        </td>
                                                        <td>
                                                            
                                                        </td>
                                                        

                                                        <td class="table-action">
                                                        
                                                        <?php 
                                                                        $user_role = \Auth::user()->role;
                                                                        if($user_role == 'admin'){
                                                                    ?>
                                                                        <a href="{{ URL::to('user-update/'.$admin_res->id.'') }}" class="action-icon text-success"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                                    <?php 
                                                                        }
                                                                    ?>
                                                                        
                                                        <a href="{{ URL::to('agents-profile/1') }}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                            
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endisset
                                          

                                                </tbody>
                                            </table>
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

                