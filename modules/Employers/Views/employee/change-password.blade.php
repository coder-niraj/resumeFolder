@extends('employee::layouts.app')
@section('title', 'admin-login')
@section('header')
@endsection
@section('style')
@endsection
@section('content')
    <div class="d-flex">
        <div class="">
            @include('employee::components.sidebar', ['active' => 'profile'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <div class="container " style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                    <div class="profile">
                        <div class="head p-4">
                            <h2>Change Password</h2>
                        </div>
                        <div class=" profile-details ">
                            <form class="col p-3 g-3 needs-validation" novalidate
                                action="{{ route('employee.change-password') }}" method="POST">
                                @csrf
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">old password</label>
                                    <input type="text" name="email" class="form-control input-bg "
                                        value="{{ $employeeObj->email }}" hidden required>
                                    <input type="text" name="current_password" class="form-control input-bg " required>
                                    @error('current_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">password</label>
                                    <input type="text" name="password" class="form-control input-bg " required>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom02" class="form-label">password
                                        confirm</label>
                                    <input type="text" name="password_confirmation" class="form-control input-bg "
                                        required>

                                </div>

                        </div>
                        <div class="row  p-3">
                            <div class="col-3">
                                <button class="btn btn-dark w-100">change password</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@section('scripts')
@endsection
