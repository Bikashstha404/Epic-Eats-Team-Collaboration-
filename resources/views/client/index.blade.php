@extends('client.client_dashboard')
@section('client')

@php
$id = Auth::guard('client')->id();
$client = App\Models\Client::find($id);
$status = $client->status;
@endphp

<div class="page-content">
    <h1><b><u>Welcome to Owner's Dashboard</u></b></h1>
</div>

@endsection