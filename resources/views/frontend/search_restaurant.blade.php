@extends('frontend.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<section class="section pt-5 pb-5 products-section">
    <div class="container">
        <div class="section-header">
            <h2>Search Results</h2>
            <p>Showing results for: "{{ $keyword }}"</p>
            <span class="line"></span>
        </div>

        @if($clients->count() > 0)
        <div class="row">

            @foreach ($clients as $client)
            <div class="col-md-3">
                <div class="item pb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm" style="min-height: 360px;">
                        <div class="list-card-image">
                            <a href="{{ route('res.details',$client->id) }}">
                                <img src="{{ !empty($client->photo) ? asset('upload/client_images/' . $client->photo) : asset('upload/no_image.jpg') }}"
                                    class="img-fluid item-img"
                                    style="min-height: 200px; width: 100%; height:200px; object-fit: cover;"
                                    alt="Restaurant Image">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="{{ route('res.details',$client->id) }}" class="text-black">{{ $client->name }}</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            <nav>
                {{-- Use Laravel's built-in pagination links --}}
                {{ $clients->appends(['search' => $keyword])->links('pagination::bootstrap-4') }}
            </nav>
        </div>

        @else
        <div class="alert alert-danger text-center">No restaurants found for "{{ $keyword }}"</div>
        @endif
    </div>
</section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.scrollTo({
            top: 400,
            behavior: 'smooth'
        });
    });
</script>