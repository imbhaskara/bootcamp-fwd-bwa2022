@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <h1>Hello, {{ Auth::user()->name }}! Welcome to MeetDoctor</h1>
            <p>Tanggal Akses: {{ date('d-m-Y h:i:s') }}</p>
        </div>
    </div>
    <!-- END: Content-->
@endsection