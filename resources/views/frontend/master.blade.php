<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <title>Epic Eats - Online Food Ordering Website</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/img/images/Logo.png') }}">
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="{{ asset('frontend/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="{{ asset('frontend/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <!-- Select2 CSS-->
    <link href="{{ asset('frontend/vendor/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('frontend/css/osahan.css') }}" rel="stylesheet">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/owl-carousel/owl.theme.css') }}">


    <style>
        .toast-success {
            background-color: #51A351 !important;
            color: white !important;
        }

        .toast-info {
            background-color: #5bc0de !important;
            color: white !important;
        }

        .toast-warning {
            background-color: #f0ad4e !important;
            color: white !important;
        }

        .toast-error {
            background-color: #d9534f !important;
            color: white !important;
        }
    </style>


</head>

<body>
    <div class="homepage-header">
        <div class="overlay"></div>

        @include('frontend.layouts.header')

        @include('frontend.layouts.banner')

    </div>

    @yield('content')


    @include('frontend.layouts.footer')
    <!-- jQuery -->
    <script src="{{ asset('frontend/vendor/jquery/jquery-3.3.1.slim.min.js') }}"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 JavaScript-->
    <script src="{{ asset('frontend/vendor/select2/js/select2.min.js') }}"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('frontend/vendor/owl-carousel/owl.carousel.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- ------------ Wishlist Add Start ----------- --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function addWishList(id) {
            //alert(id)
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/add-wish-list/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    // Start Message 

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })

                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }

                    // End Message  


                }
            })

        }
    </script>


    <!-- ✅ jQuery -->


    <!-- ✅ jQuery UI CSS & JS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- ✅ Autocomplete Script -->
    <script>
        function goToRestaurant() {
            const url = $('#redirectURL').val();
            if (url) {
                window.location.href = url;
            }
        }

        $(function() {
            $("#restaurantSearch").autocomplete({
                source: "{{ route('restaurant.autocomplete') }}",
                minLength: 1,
                select: function(event, ui) {
                    $('#restaurantSearch').val(ui.item.label);
                    $('#redirectURL').val(ui.item.value);
                    goToRestaurant();
                    return false;
                }
            });
        });
    </script>

    <!-- ✅ Wishlist Toggle Script -->
    <script>
        $(document).on('click', '.wishlist-toggle', function() {
            var el = $(this);
            var clientId = el.data('id');

            $.ajax({
                url: "/wishlist/toggle",
                type: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: {
                    _token: '{{ csrf_token() }}',
                    client_id: clientId
                },
                success: function(response) {
                    var icon = el.find('i');
                    if (response.status === 'added') {
                        icon.removeClass('text-muted').addClass('text-danger');
                        toastr.success('Added to your wishlist!');
                    } else if (response.status === 'removed') {
                        icon.removeClass('text-danger').addClass('text-muted');
                        toastr.info('Removed from your wishlist!');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        toastr.warning('Please login to add to your wishlist!');
                    }
                }
            });
        });
    </script>

    <!-- Load jQuery First -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Load Toastr CSS & JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    </script>

    <!-- Show Toastr Message -->
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        var message = @json(Session::get('message'));
        console.log("Type:", type);
        console.log("Message:", message);

        switch (type) {
            case 'info':
                toastr.info(message);
                break;
            case 'success':
                toastr.success(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'error':
                toastr.error(message);
                break;
        }
        @endif
    </script>

</body>