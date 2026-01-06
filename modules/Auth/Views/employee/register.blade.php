@extends('admin::layouts.app')
@section('title', 'admin-login')
@section('header')
@endsection
@section('style')
@endsection
@section('content')

    <div class=" main-block" style="overflow: hidden;">
        <div class="row bg-shadow auth-form " style="height: 95vh;">
            <div class="col-8 my-bg image-panel"></div>
            <div class="col-4 d-flex form-panel align-items-center justify-content-center">

                <form action="{{ route('employee.register') }}" method="POST" class="row px-4 register-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="title  fw-bold h1">Register</div>
                    <div class="row">
                        <div class="form-group col-6">
                            <input id="my-input" placeholder="Enter First Name..."
                                class="form-control p-0 border-0 border-bottom rounded-0" type="text" name="firstname">
                            @error('firstname')
                                <small class="text-danger text-sm">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">

                            <input id="my-input" placeholder="Enter Last Name..."
                                class="form-control p-0 border-0 border-bottom rounded-0" type="text" name="lastname">
                            @error('lastname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-11">

                        <input id="my-input" placeholder="Enter Email..."
                            class="form-control p-0 border-0 border-bottom rounded-0" type="text" name="email">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group  col-11">

                        <input id="my-input" placeholder="Enter Password..."
                            class="form-control p-0 border-0 border-bottom rounded-0" type="text" name="password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group  col-6">

                            <input id="my-input" placeholder="Company Name..."
                                class="form-control p-0 border-0 border-bottom rounded-0" type="text"
                                name="company_name">
                            @error('company_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">

                            <input id="my-input" placeholder="Company Website..."
                                class="form-control p-0 border-0 border-bottom rounded-0" type="text"
                                name="company_website">
                            @error('company_website')
                                <small class="text-danger small">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <input id="my-input" placeholder="Enter Phone..."
                                class="form-control p-0 border-0 border-bottom rounded-0" type="number" name="phone">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">

                            <input id="my-input" placeholder="Enter address..."
                                class="form-control p-0 border-0 border-bottom rounded-0" type="text" name="address">
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-11 d-flex  text-center" style="height: 4vh; position: relative;">
                        <button class="btn btn-secondary "
                            style="pointer-events: none; position: absolute;z-index: 0;">Choose Avatar</button>

                        <input id="my-input" class="form-control " style="width: 130px; opacity: 0; z-index: 10;"
                            type="file" name="avatar">
                        @error('avatar')
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                    @enderror
            </div>
            <div class="row">
                <div class="form-group col-11" style="">
                    <button type="submit" class="btn  btn-dark w-100 py-2 mt-2">Submit</button>
                </div>

                <div class="form-group col-11 text-center " style="height: fit-content;">
                    <p class="text-muted small mt-1">
                        Already have an account? <a href={{ route('employee.login.view') }}>Login</a>
                    </p>
                </div>
            </div>
            </form>

        </div>
    </div>
    </div>


@endsection
@section('scripts')
@endsection
