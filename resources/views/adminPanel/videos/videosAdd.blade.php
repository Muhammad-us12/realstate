
         @extends('adminPanel/master')  
         @section('style')
          
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
                                                <h4>Add Video</h4>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="text-sm-end">
                                                    <a href="{{ URL::to('videos-list') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i>Offers List</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                                        <form action="{{ URL::to('video-submit') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Title</label>
                                                        <input type="text" id="example-input-normal"  name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Title">
                                                        @error('title')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Category</label>
                                                        <select class="form-select select2" name="video_category" id="example-select">
                                                            @isset($allCategories)
                                                                @foreach($allCategories as $cat_res)
                                                            <option value="{{ $cat_res->id }}">{{ $cat_res->category_name }}</option>
                                                                @endforeach
                                                            @endisset
                                                        </select>
                                                        @error('video_category')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">Select Socitey</label>
                                                        <select class="form-select select2" name="scoiety_id" id="example-select">
                                                            @isset($societies_data)
                                                                @foreach($societies_data as $scoitey_res)
                                                            <option value="{{ $scoitey_res->id }}">{{ $scoitey_res->society_name }}</option>
                                                                @endforeach
                                                            @endisset
                                                        </select>
                                                        @error('scoiety_id')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="example-fileinput" class="form-label">Enter Link</label>
                                                        <input type="text"  id="video_link_input" name="video_link" class="form-control">
                                                        @error('video_link')
                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="mb-3">
                                                        <div class="btn btn-success mt-3" onclick="displayVideo()">+</div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <iframe width="300" height="215" id="video_iframe"
                                                            src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <label for="example-textarea" class="form-label">Add Description</label>
                                                        <textarea id="summernote" name="description"></textarea>
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

                displayVideo = () =>{
                    var videoLink = $('#video_link_input').val();
                    console.log(videoLink);
                    var url = 'https://www.youtube.com/embed/'+videoLink+'';
                    console.log(url);
                    $('#video_iframe').attr('src',url)
                }

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

                