
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
                                    <h4 class="page-title">Scoieties</h4>
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
                                                <h4>Societies List</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('add-society') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add New Society</a>
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
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @isset($Societies_data)
                                                        @foreach($Societies_data as $society_res)
                                                            <tr>
                                                                <td>
                                                                    {{ $society_res->id }}
                                                                </td>
                                                                <td>
                                                                    <img src="public/images/Societies/{{ $society_res->picture }}" style="width:100px; height:100px" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />
                                                                
                                                                </td>
                                                                <td>
                                                                    {{ $society_res->society_name }}

                                                                   
                                                                </td>
                                                                <td>
                                                                    {{ $society_res->SocietyLocation->location_name }}
                                                                </td>
                                                             
                                                                
                                                                <td class="table-action">
                                                                <?php 
                                                                    $user_role = \Auth::user()->role;
                                                                    if($user_role == 'admin'){
                                                                ?>
                                                                <a href="{{ URL::to('society-update/'.$society_res->id.'') }}" class="action-icon text-success"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                                <?php 
                                                                    }
                                                                ?>
                                                                    
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                    
                                                </tbody>
                                            </table>

                                            {!! $Societies_data->links() !!}
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>

                 

                 
         @endsection

         @section('scripts')
            <script>
                @if(session('success'))
                    $(document).ready(function(){
                        $("#success-alert-modal").modal('show');
                    })  
                @endif
            </script>

         <script src="{{ asset('public/adminPanel/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
         <script src="{{ asset('public/adminPanel/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
         
            <script>
                
                publishBlog = (blogId)=>{
                    console.log('this is call now')
                    $("#standard-modal").modal('show');
                   
                    $('#blog_id').val(blogId);
                }
                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
                console.log('page is load now');
            </script>         
         @endsection
                    <!-- container -->

                