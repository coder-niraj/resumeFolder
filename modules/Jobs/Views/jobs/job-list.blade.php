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
                <div class="container" style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                    <div class="row title">
                        <h2>
                            Job Post Form
                        </h2>
                    </div>
                    <div class="form row">
                        <div class="col-6">
                                    <label for="validationCustom01" class="form-label">Title</label>
                                    <input type="text" class="form-control input-bg " j
                                         name="firstname" required>
                                </div>
                        <div class="col-6">
                                    <label for="validationCustom01" class="form-label">Description</label>
                                   ,<textarea name="" class="form-control" id=""></textarea>
                                </div>
                        <div class="col-6">
                                    <label for="validationCustom01" class="form-label">skills</label>
                                    <input type="text" class="form-control input-bg " j
                                         name="firstname" required>
                                </div>
                        
                        <div class="col-6">
                                    <label for="validationCustom01" class="form-label">experience</label>
                                    <input type="text" class="form-control input-bg " j
                                         name="firstname" required>
                                </div>
                        <div class="col-6">
                                    <label for="validationCustom01" class="form-label">work_type</label>
                                      <select class="form-select custom-select-lg mb-3">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                        <div class="col-6">
                                    <label for="validationCustom01" class="form-label">job_type</label>
                                     <select class="form-select custom-select-lg mb-3">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">job_time</label>
                                    <input type="text" class="form-control input-bg " j
                                        name="firstname" required>
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">salary_min</label>
                                    <input type="text" class="form-control input-bg " j
                                         name="firstname" required>
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">salary_max</label>
                                    <input type="text" class="form-control input-bg " j
                                        name="firstname" required>
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">education</label>
                                    <input type="text" class="form-control input-bg " j
                                        name="firstname" required>
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">ending_date</label>
                                    <input type="text" class="form-control input-bg " j
                                        name="firstname" required>
                                </div>
                            </div>
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
