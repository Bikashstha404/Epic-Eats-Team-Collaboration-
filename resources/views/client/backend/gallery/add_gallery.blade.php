@extends('client.client_dashboard')
@section('client')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Add Gallery</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Galler </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body p-4">

                        <form id="myForm" action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">

                                        <div class="form-group mb-3">
                                            <label for="example-text-input" class="form-label">Gallery Image</label>
                                            <input class="form-control" name="gallery_img[]" type="file" id="multiImg" multiple accept="image/*">
                                            <div class="row" id="preview_img"></div>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>










                <!-- end tab content -->
            </div>
            <!-- end col -->


            <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>

<script>
    $(document).ready(function() {

        // Custom method to check image file types
        $.validator.addMethod("imageOnly", function(value, element) {
            var files = element.files;
            if (files.length === 0) return false;

            for (let i = 0; i < files.length; i++) {
                if (!files[i].type.match('image.*')) {
                    return false;
                }
            }
            return true;
        }, "Please upload only image files.");

        // Apply validation
        $('#myForm').validate({
            rules: {
                'gallery_img[]': {
                    required: true,
                    imageOnly: true
                }
            },
            messages: {
                'gallery_img[]': {
                    required: "Please select at least one image."
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(210)
                                    .height(120); //create image element 
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>


@endsection