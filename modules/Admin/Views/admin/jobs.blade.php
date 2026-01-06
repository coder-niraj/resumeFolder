@extends('admin::layouts.app')
@section('title', 'admin-login')
@section('header')
@endsection
@section('style')
@endsection
@section('content')
    <div class="d-flex">
        <div class="">
            @include('admin::components.sidebar', ['active' => 'jobs'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <div class="container " style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                    jobs
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
