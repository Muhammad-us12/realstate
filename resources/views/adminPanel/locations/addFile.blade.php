
         @extends('adminPanel/master') 
         @section('style')
            <!-- Quill css -->
            <link href="{{ asset('public/adminPanel/assets/css/vendor/quill.bubble.css') }}" rel="stylesheet" type="text/css" />

            <link href="{{ asset('public/adminPanel/assets/css/vendor/quill.core.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/adminPanel/assets/css/vendor/quill.snow.css') }}" rel="stylesheet" type="text/css" />
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
                                    <h4 class="page-title">Files</h4>
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
                                                <h4>Add File</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i>Files List</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <form action="{{ URL::to('files-submit') }}" method="post">
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-sm-2">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Id</label>
                                                        <input type="text" id="example-input-normal" name="example-input-normal" class="form-control" placeholder="Normal">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Registration No.</label>
                                                        <input type="text" id="example-input-normal" name="registration_no" value="{{ old('registration_no') }}" class="form-control" placeholder="Registration No">
                                                        @error('registration_no')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror 
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Location</label>
                                                        <select class="form-control select2" name="location_id" onchange="fetchLocatonsSocities()" id="file_location" data-toggle="select2">
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

                                                <div class="col-sm-2">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Block</label>
                                                        <select class="form-control select2" id="block" name="block_id" data-toggle="select2">
                                                        
                                                        </select>
                                                        @error('block_id')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror 
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="example-fileinput" class="form-label">Purchase Amount</label>
                                                        <input type="text" id="example-input-normal" name="purchase_amount" value="{{ old('purchase_amount') }}" class="form-control" placeholder="Purchase Amount">
                                                        @error('purchase_amount')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Purchase Date</label>
                                                        <input type="date" class="form-control date" name="purchase_date" value="{{ old('purchase_date') }}" >
                                                        @error('purchase_date')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Payment From</label>
                                                        <select class="form-control select2" name="account_id" data-toggle="select2">
                                                            @isset($CashAccounts_data)
                                                                    @foreach($CashAccounts_data as $account_res)
                                                                    <option value="{{ $account_res->id }}">{{ $account_res->account_name }} / {{ $account_res->account_number }}</option>
                                                                    @endforeach
                                                            @endisset
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-5">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Marla</label>
                                                        <select class="form-control select2" name="marala_type" id="select_marala" data-toggle="select2">
                                                                
                                                        </select>
                                                        @error('marala_type')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-1">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-success" style="margin-top: 1.7rem;" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="mdi mdi-plus-circle me-2"></i></button>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Sate Type</label>
                                                        <select class="form-control select2" name="state_type" data-toggle="select2">
                                                                <option value="Commerical">Commerical</option>
                                                                <option value="Residentail">Residentail</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="example-textarea" class="form-label">Add Description</label>
                                                        <textarea id="summernote" name="description">{{ old('description') }}</textarea>
                                                        @error('description')
                                                                <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror    
                                                </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                       

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
                                    <h4 class="modal-title" id="standard-modalLabel">Add Marala Type</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                               
                                    <div class="modal-body">
                                
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Add Marala</label>
                                            <input type="text" class="form-control" name="marala" id="marala" aria-describedby="emailHelp" placeholder="Enter Marala">
                                        </div>
                                        
                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="addMaralaType()" class="btn btn-primary">Save changes</button>
                                    </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div id="success-alert-marala" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-success">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-checkmark h1"></i>
                                        <h4 class="mt-2">Well Done!</h4>
                                        <p class="mt-3">Marala is Added Successfully</p>
                                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <div id="error-alert-modal_marla" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-danger">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-wrong h1"></i>
                                        <h4 class="mt-2">Oh snap!</h4>
                                        <p class="mt-3">Something Went Wrong Try Again</p>
                                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
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

                @if(session('error'))
                    $(document).ready(function(){
                            $("#error-alert-modal").modal('show');
                    })
                @endif

                addMaralaType = ()=>{
                    $.ajax({
                        url:"{{ URL::to('add_marala_type') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'marala':$('#marala').val()
                        },
                        success:function(data) {
                            $('#standard-modal').modal('hide');
                            
                            if(data){
                                $('#success-alert-marala').modal('show');
                            }else{
                                $('#error-alert-modal_marla').modal('show');
                            }

                            fetchMaralaTypes();
                        }
                    });
                    // $('#category_id').val(catId);
                }

                fetchMaralaTypes = ()=>{
                    $.ajax({
                        url:"{{ URL::to('fetch_marala_type') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'marala':$('#marala').val()
                        },
                        success:function(data) {
                            let maralsHtml = ``;
                            data.forEach((marala)=>{
                                maralsHtml += `<option value="${marala['id']}">${marala['marala']}</option>`
                                
                            });

                            $('#select_marala').html(maralsHtml);
                        }
                    });
                }

                fetchMaralaTypes();

                fetchLocatonsSocities = ()=>{
                    $.ajax({
                        url:"{{ URL::to('fetch_socities_wi_location') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'location_id':$('#file_location').val()
                        },
                        success:function(data) {
                            console.log(data);
                            let socititesHtml = ``;
                            data.forEach((scoities)=>{
                                socititesHtml += `<option value="${scoities['id']}">${scoities['society_name']}</option>`
                                
                            });

                            $('#societies').html(socititesHtml);
                            fetchSocitiesBlocks();
                        }
                    });
                }

                fetchSocitiesBlocks = ()=>{
                    $.ajax({
                        url:"{{ URL::to('fetch_blocks_wi_scotites') }}",
                        type:'POST',
                        data:{
                            '_token' : '<?php echo csrf_token() ?>',
                            'scoitiy_id':$('#societies').val()
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

                fetchLocatonsSocities();
                $(document).ready(function() {
                    $('#summernote').summernote({
                        placeholder: 'Hello stand alone ui',
                        tabsize: 2,
                        height: 150,
                        toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });
                });
            </script>
         @endsection
                    <!-- container -->

                