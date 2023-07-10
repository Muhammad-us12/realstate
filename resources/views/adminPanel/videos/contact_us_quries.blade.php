
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
                                    <h4 class="page-title">Contact Us Messages</h4>
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
                                                <h4>Contact Us Messages</h4>
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
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th style="width: 85px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @isset($contact_us)
                                                        @foreach($contact_us as $contact_res)
                                                            <tr>
                                                                <td>
                                                                    {{ $contact_res->id }}
                                                                </td>
                                                                <td>
                                                                    {{ $contact_res->name }}
                                                                </td>
                                                                <td>
                                                                    
                                                                    {{ $contact_res->email }}
                                                                   
                                                                </td>
                                                                <td>
                                                                    {{ $contact_res->subject }}
                                                                </td>
                                                                <td>
                                                                    {{ Str::limit($contact_res->message, 30)  }}
                                                                    <input type="text" id="cont_{{ $contact_res->id }}" hidden value="{{ $contact_res->message }}">
                                                                    <br>
                                                                    <a href="#standard-modal" data-bs-toggle="modal" data-bs-target="" onclick="contact_us_message_function({{ $contact_res->id }})">View Message</a>
                                                                </td>
                                                                
                                                                <td class="table-action">
                                                                  <a href="{{ URL::to('delete-query/'.$contact_res->id.'') }}" onclick="return confirm('Are you sure, you want to delete it?')" class="btn btn-sm btn-danger"><i class="dripicons-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                    
                                                </tbody>
                                            </table>

                                            {!! $contact_us->links() !!}
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
                                    <h4 class="modal-title" id="standard-modalLabel">Message</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                            
                                    <div class="modal-body">
                                
                                      <p id="contact_us_message"></p>
                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                 
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
                
                contact_us_message_function = (id)=>{
                    console.log(id);
                    var messag_data = $('#cont_'+id+'').val();
                    $('#contact_us_message').html(messag_data);
                }
                
                $("#scroll-horizontal-datatable").DataTable({scrollX:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}})
                console.log('page is load now');
            </script>         
         @endsection
                    <!-- container -->

                