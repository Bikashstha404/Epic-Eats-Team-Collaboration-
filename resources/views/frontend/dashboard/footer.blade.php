{{-- FONTS (add this in your <head> tag of master.blade.php or layout) --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto&display=swap" rel="stylesheet">

{{-- ABOUT SECTION WITH BACKGROUND IMAGE --}}
<section class="about-us-section py-5 text-center"
         style="position: relative; background: url('{{ asset('frontend/img/footerbg1.jpg') }}') no-repeat center center / cover;">
    {{-- Dark overlay to improve text visibility --}}
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>
    
    <div class="container position-relative" style="z-index: 2;">
        <div class="row">
            <div class="col-md-12">
                <h5 class="fw-bold mb-3"
                    style="font-family: 'Poppins', sans-serif; font-weight:bolder; font-size: 30px; color: #fff;">
                    About Us
                </h5>
                <p class="mb-0 px-2"
                   style="font-family: 'Roboto', sans-serif; font-size: 16px; max-width: 800px; margin: 0 auto; color: #fff;">
                    Hungry? We’ve got you! Your favorite restaurants, delivered fast and fresh — wherever you are.
                    Easy ordering, quick delivery, and endless delicious options. Because great food should never wait!
                </p>
            </div>
        </div>
    </div>
</section>

{{-- COPYRIGHT FOOTER --}}
<footer class="pt-4 pb-4 text-center text-white" style="background-color: #fff;">
    <div class="container">
        <p class="mt-0 mb-0" style="font-family: 'Poppins', sans-serif; color: #222;">
            © Copyright 2025 EpicEats. All Rights Reserved
        </p>
    </div>
</footer>
