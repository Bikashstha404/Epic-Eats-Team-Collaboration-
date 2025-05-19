@extends('client.client_dashboard')
@section('client')

    @php
        $id = Auth::guard('client')->id();
        $client = App\Models\Client::find($id);
        $status = $client->status;
    @endphp

    <div class="page-content">
        <h1 class="mb-4"><b><u>Welcome to Owner's Dashboard</u></b></h1>

            @if ($status === '1')
        <h4>Restaunt Account is <span class="text-success">Active</span> </h4>
    @else
        <h4>Restaurant Account is <span class="text-danger">InActive</span> </h4>
        <p class="text-danger"><b>Plz wait admin will check and approve your account </b> </p>
    @endif
    </div>



@endsection