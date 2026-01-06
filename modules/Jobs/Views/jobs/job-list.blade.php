@extends('jobs::layouts.app')
@section('title', 'employee')
@section('header')
@endsection
@section('style')
@endsection
@section('content')
    <div class="d-flex">
        <div class="">
            @include('jobs::components.sidebar', ['active' => 'nothing'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <div class="container " style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                    job list
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
{{-- 
            
            string('title')
            text('description')
            json('skills')
            text('experience')
            uuid('location_id')->nullable();   
            enum('work_type', ['remote', 'on-site', 'hybrid'])
            boolean('active')->default(true)
            unsignedInteger('applications_count')->default(0)
            enum('job_type', ['full-time', 'part-time', 'contract', 'internship', 'temporary'])
            enum('job_time', ['day', 'night', 'flexible'])
            decimal('salary_min')->nullable()
            decimal('salary_max')->nullable()
            string('education')->nullable()
            date('ending_date')->nullable()
            timestamp('posted_at')->nullable() 
            --}}
