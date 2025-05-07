<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner Section</title>

    <!-- Inline CSS for the Banner Section -->
    <style>
        /* === Homepage Banner Styles === */
        .homepage-search-block {
            position: relative;
            height: 770px;
            overflow: hidden;
        }

        .img-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); /* Dark overlay for better text contrast */
            z-index: 2;
        }

        .homepage-search-block .container {
            position: relative;
            z-index: 3;
        }

        .homepage-search-title h1,
        .homepage-search-title h5 {
            font-weight: 400;
            margin-bottom: 1rem;
        }

        .homepage-search-title h1 {
            font-size: 3rem;
            line-height: 1.2;
        }

        .homepage-search-title h5 {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-gradient {
            background: linear-gradient(to right,rgb(255, 85, 0),rgb(209, 84, 0));
            color: #fff;
            padding: 8px 20px;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            font-size: 1.25rem;
        }

        .btn-gradient:hover {
            background: linear-gradient(to right, #0062cc, #00c4a1);
        }

        /* Adjust the input field and icon inside the search bar */
        .homepage-search-form .form-group {
            position: relative;
        }

        .homepage-search-form .form-group input {
            padding-right: 40px;
            border-radius: 20px;
            font-size: 1rem;
            height: 50px;
        }

        .homepage-search-form .form-group i {
            position: absolute;
            top: 50%;
            right: 25px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #666;
        }

        /* Style for smaller search button */
        .homepage-search-form .col-lg-1 .btn {
            padding: 10px 15px;
            font-size: 1rem;
            font-weight: 600;
            min-width: 100px;
            width: auto;
            border-radius: 30px;
        }
    </style>
</head>

<body>

    <!-- === Homepage Banner Start === -->
    <section class="homepage-search-block position-relative">
        <!-- Background Image -->
        <img src="{{ asset('frontend/img/dashboard.jpg') }}" alt="Dashboard Banner" class="img-bg">

        <!-- Optional Overlay -->
        <div class="banner-overlay"></div>

        <!-- Content Container -->
        <div class="container h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-lg-10 text-center">
                    <!-- Title -->
                    <div class="homepage-search-title text-white">
                        <h1 class="mb-3 display-4 font-weight-bold" style="color: white">
                            Discover the best food & drink varieties in a swipe
                        </h1>
                        <h5 class="mb-5 text-white-50 font-weight-normal">
                            Find top-rated restaurants near you
                        </h5>
                    </div>

                    <!-- Search Form -->
                    <div class="homepage-search-form">
                        <form>
                            <div class="form-row justify-content-center">
                                <div class="col-lg-8 col-md-9 col-sm-12 form-group position-relative">
                                    <input type="text" placeholder="Search here..." class="form-control form-control-lg rounded-pill">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div class="col-lg-1 col-md-3 col-sm-12 form-group">
                                    <a href="listing.html" class="btn btn-gradient rounded-medium text-white">
                                        Search
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- === Homepage Banner End === -->

</body>

</html>
