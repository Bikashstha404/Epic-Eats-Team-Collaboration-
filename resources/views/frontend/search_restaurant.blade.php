@extends('frontend.master')

@section('content')
<div class="container pt-5">
    <h4 class="mb-4">Search results for: "{{ $keyword }}"</h4>

    @if($clients->count() > 0)
        <div class="row">
            @foreach($clients as $client)
                <div class="col-md-3 mb-4">
                    <div class="card shadow h-100 d-flex flex-column justify-content-between">
                        <a href="{{ route('res.details', $client->id) }}">
                            <img src="{{ !empty($client->photo) ? asset('upload/client_images/' . $client->photo) : asset('upload/no_image.jpg') }}"
                                 class="card-img-top"
                                 style="height: 250px; object-fit: cover;"
                                 alt="{{ $client->name }}">
                        </a>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-center mt-2">
                                <a href="{{ route('res.details', $client->id) }}" class="text-dark">
                                    {{ $client->name }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger">No restaurants found for "{{ $keyword }}"</div>
    @endif
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.scrollTo({
            top: 400,
            behavior: 'smooth'
        });
    });
</script>




