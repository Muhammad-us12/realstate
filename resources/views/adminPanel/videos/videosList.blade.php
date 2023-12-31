
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
                                    <h4 class="page-title">Videos</h4>
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
                                                <h4>Videos List</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('offers-add') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add New Offer</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table id="scroll-horizontal-datatable" class="table table-centered w-100 nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                      
                                                        <th>ID</th>
                                                        <th>Video</th>
                                                        <th>Title</th>
                                                        <th>Category</th>
                                                        <th>Society</th>
                                                        <th>Status</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @isset($video_data)
                                                        @foreach($video_data as $video_res)
                                                            <tr>
                                                                <td>
                                                                    {{ $video_res->id }}
                                                                </td>
                                                                <td>
                                                                <iframe width="200" height="150" id="video_iframe"
                                                                    src="https://www.youtube.com/embed/{{ $video_res->video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                
                                                                </td>
                                                                <td>
                                                                    

                                                                   
                                                                </td>
                                                                <td>
                                                                    {{ $video_res->VideoCategory->category_name }}
                                                                </td>
                                                                <td>
                                                                    {{ $video_res->OfferSociety->society_name }}
                                                                </td>
                                                                <td>
                                                                @php
                                                                     if($video_res->status == 'pending'){
                                                                        $isActive = false;
                                                                     }else{
                                                                        $isActive = true;
                                                                     }
                                                                
                                                                @endphp
                                                                    <span @class([
                                                                        'badge',
                                                                        'bg-success' => $isActive,
                                                                        'bg-danger' => ! $isActive,
                                                                    ])>{{ $video_res->status  }}</span> 
                                                                </td>
                                                                
                                                                <td class="table-action">
                                                                    @if(!$isActive)

                                                                    <a href="javascript:void(0);" onclick="publishBlog({{ $video_res->id }})" class="action-icon text-success" title="Publish"> <i class="mdi mdi-checkbox-multiple-marked-outline"></i></a>
                                                                    @endif
                                                                    <a href="{{ URL::to('videos-update/'.$video_res->id.'') }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                    
                                                </tbody>
                                            </table>

                                            {!! $video_data->links() !!}
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                     
                        <!-- end row -->

                    </div>

                    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-information h1 text-info"></i>
                                        <h4 class="mt-2">Are You Sure!</h4>
                                        <p class="mt-3">Are You Sure To Publish This Post.</p>
                                        
                                        <form action="{{ URL::to('update_video_status') }}" method="post">
                                            @csrf
                                            <input type="text" class="form-control" hidden name="blog_id" id="blog_id" aria-describedby="emailHelp" placeholder="Enter Category">
                                            <input type="text" class="form-control" hidden value="publish" name="status" id="blog_id" aria-describedby="emailHelp" placeholder="Enter Category">

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

                