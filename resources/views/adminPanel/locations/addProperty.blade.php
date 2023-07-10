
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
                                    <h4 class="page-title">Property</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form action="{{ URL::to('property-submit') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-sm-5">
                                                    <h4>Add Property</h4>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="text-sm-end">
                                                        <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i>Property List</a>
                                                    </div>
                                                </div><!-- end col-->
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-sm-2">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Id</label>
                                                        <input type="text" id="example-input-normal" readonly name="area" value="{{ old('area') }}" class="form-control" placeholder="Normal">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Title</label>
                                                        <input type="text" required name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Title">
                                                    </div>
                                                </div>
                                                

                                                <div class="col-sm-3">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Location</label>
                                                        <select class="form-control select2" name="location_id" onchange="fetchLocatonsSocities()"  id="file_location" data-toggle="select2">
                                                            @isset($Location_data)
                                                                @foreach($Location_data as $location_res)
                                                                <option value="{{ $location_res->id }}">{{ $location_res->location_name }}</option>
                                                                @endforeach
                                                            @endisset
                                                        </select>
                                                        @error('location_id')
                                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror 
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

                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Picture</label>
                                                        <input type="file" name="img" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Sate Type</label>
                                                        <select class="form-select" id="Propertytype" name="property_type" onchange="checkPropertyType()">
                                                                <option value="Commerical">Commerical</option>
                                                                <option value="Residentail">Residentail</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 Residentail">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Property Type</label>
                                                        <select class="form-select" name="property_type_resid">
                                                                <option value="Shop">Shop</option>
                                                                <option value="Plot">Plot</option>
                                                                <option value="House">House</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            
                                                <div class="col-sm-2 Residentail">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Marla</label>
                                                        <select class="form-control select2" name="marala_type" id="select_marala" data-toggle="select2">
                                                                
                                                        </select>
                                                 
                                                    </div>
                                                </div>

                                                <div class="col-sm-1 Residentail">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-success" style="margin-top: 1.7rem;" data-bs-toggle="modal" data-bs-target="#standard-modal"><i class="mdi mdi-plus-circle me-2"></i></button>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 Commerical">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Property Type</label>
                                                        <select class="form-select" name="property_type_comm">
                                                                <option value="Plot">Plot</option>
                                                                <option value="Plaza">Plaza</option>
                                                                <option value="Shop">Shop</option>
                                                                <option value="House">House</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 Commerical">
                                                    <div class="mb-3">
                                                        <label for="example-fileinput" class="form-label">Area</label>
                                                        <input type="text" id="example-input-normal" name="area" value="{{ old('area') }}" class="form-control" placeholder="Enter Area">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 Commerical">
                                                    <div class="mb-3">
                                                        <label for="example-fileinput" class="form-label">Road Size</label>
                                                        <input type="text" id="example-input-normal" name="road_size" value="{{ old('road_size') }}"  class="form-control" placeholder="Enter Road Size">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 Commerical">
                                                    <div class="mb-3">
                                                        <label for="example-fileinput" class="form-label">Street Size</label>
                                                        <input type="text" id="example-input-normal" name="street_size" value="{{ old('street_size') }}" class="form-control" placeholder="Enter Street Size">
                                                    </div>
                                                </div>

                                                

                                                <div class="col-sm-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Demand Amount</label>
                                                        <input type="number" id="example-input-normal" required name="demand_amount" value="{{ old('demand_amount') }}" class="form-control" placeholder="Purchase Amount">
                                                        @error('demand_amount')
                                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror 
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">FNF Amount</label>
                                                        <input type="number" id="example-input-normal" required name="taken_amount" value="{{ old('taken_amount') }}" class="form-control" placeholder="Purchase Amount">
                                                        @error('taken_amount')
                                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror 
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Owner Name</label>
                                                        <input type="text" id="example-input-normal" name="owner_name" value="{{ old('owner_name') }}" class="form-control" placeholder="Enter Name">
                                                        @error('owner_name')
                                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror 
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">Owner Contact</label>
                                                        <input type="text" id="example-input-normal" name="owner_phone" value="{{ old('owner_phone') }}" class="form-control" placeholder="Enter Phone No.">
                                                        @error('owner_phone')
                                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror 
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Customer</label>
                                                        <select class="form-control select2" name="customer_id" data-toggle="select2">
                                                            @isset($Customers_data)
                                                                @foreach($Customers_data as $cust_res)
                                                                <option value="{{ $cust_res->id }}">{{ $cust_res->id }} / {{ $cust_res->custfname." ".$cust_res->custlname }}</option>
                                                                @endforeach
                                                            @endisset
                                                        </select>
                                                        @error('customer_id')
                                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror 
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Officer</label>
                                                        <select class="form-control select2" name="agent_id" data-toggle="select2">
                                                            @isset($Agent_data)
                                                                @foreach($Agent_data as $agent_res)
                                                                <option value="{{ $agent_res->id }}">{{ $agent_res->id }} / {{ $agent_res->fname." ".$agent_res->lname }}</option>
                                                                @endforeach
                                                            @endisset
                                                        </select>
                                                        @error('agent_id')
                                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                            @enderror 
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

                                        </div> <!-- end card-body-->
                                    </form>
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
         <script src="{{ asset('public/adminPanel/assets/js/vendor/quill.min.js') }}"></script>
         <script src="{{ asset('public/adminPanel/assets/js/pages/demo.quilljs.js') }}"></script>
           
         <script>
            addMoreFaclities = ()=>{
            let moreFacliHtml = ` <div class="row">
                                    <div class="col-sm-10">
                                        <div class="mb-3">
                                            <label for="example-fileinput" class="form-label">Add Facilities</label>
                                            <input type="text" id="example-input-normal" name="facilities[]" class="form-control" placeholder="Add Facilities">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 Residentail">
                                        <div class="mb-3">
                                            <button class="btn btn-danger" style="margin-top:1.7rem" onclick="removeFaclities()"><i class="mdi mdi-minus-circle me-2"></i></button>
                                        </div>
                                    </div>
                                </div>`;
                $('#faclitites').append(moreFacliHtml);
            }

            checkPropertyType = ()=>{
                let type = $('#Propertytype').val();
                if(type == 'Commerical'){
                    $('.Residentail').css('display','none');
                    $('.Commerical').css('display','block');
                }else{
                    $('.Residentail').css('display','block');
                    $('.Commerical').css('display','none');
                }
            }

            checkPropertyType();

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

            fetchLocatonsSocities()

            
            
            
            
            
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

                