
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
                                    <h4 class="page-title">Change Password</h4>
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
                                                <h4 class="page-title">Files Reports</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                <!-- <a href="{{ URL::to('payments-add') }}" class="btn btn-success" ><i class="mdi mdi-plus-circle me-2"></i>Add Payment</a> -->
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{ URL::to('change_password') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12 mb-2">
                                                            <label for="">Previous Password</label>
                                                            <input type="password" name="prev_password" required class="form-control" id="">
                                                        </div>

                                                        <div class="col-md-12 mb-2">
                                                            <label for="">New Password</label>
                                                            <input type="password" name="password" class="form-control" id="">
                                                            @error('password')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                             @enderror
                                                        </div>

                                                        <div class="col-md-12 mb-2">
                                                            <label for="">Re Enter Password</label>
                                                            <input type="password" name="password_confirmation" class="form-control" id="">
                                                            @error('password_confirmation')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                             @enderror
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn-success btn">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
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

                