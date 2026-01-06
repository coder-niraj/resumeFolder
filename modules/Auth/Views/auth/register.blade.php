@extends('admin::layouts.app')
@section('title', 'admin-login')
@section('header')
@endsection
@section('style')
@endsection
@section('content')

    <div class="m-5">
        <div class="row bg-shadow auth-form " style="height: 85vh;">
            <div class="col-8 my-bg image-panel"></div>
            <div class="col-4 d-flex form-panel align-items-center justify-content-center">

                <form action="{{ route('user.register') }}" method="POST" class="row px-4" enctype="multipart/form-data"
                    style="height: 80vh">
                    @csrf
                    <div class="title fw-bold py-3 h1">Register</div>
                    <div class="form-group col-11">
                        <input id="my-input" placeholder="Enter First Name..."
                            class="form-control p-2 border-0 border-bottom rounded-0" type="text" name="firstname">
                        @error('firstname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-11">

                        <input id="my-input" placeholder="Enter Last Name..."
                            class="form-control p-2 border-0 border-bottom rounded-0" type="text" name="lastname">
                        @error('lastname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-11">

                        <input id="my-input" placeholder="Enter Email..."
                            class="form-control p-2 border-0 border-bottom rounded-0" type="text" name="email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group  col-11">

                        <input id="my-input" placeholder="Enter Password..."
                            class="form-control p-2 border-0 border-bottom rounded-0" type="text" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-11">

                        <input id="my-input" placeholder="Enter Phone..."
                            class="form-control p-2 border-0 border-bottom rounded-0" type="number" name="phone">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-11 d-flex  text-center" style="height: 4vh; position: relative;">
                        <button class="btn btn-secondary "
                            style="pointer-events: none; position: absolute;z-index: 0;">Choose Avatar</button>

                        <input id="my-input" class="form-control " style="width: 130px; opacity: 0; z-index: 10;"
                            type="file" name="avatar">
                        @error('avatar')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-11" style="height: 20px  ">
                        <button type="submit" class="btn  btn-dark w-100 py-2 mt-3">Submit</button>
                    </div>

                    <div class="form-group col-11 text-center " style="height: 20px;">
                        <p class="text-muted small mt-4">
                            Already have an account? <a href={{ route('user.login.view') }}>Login</a>
                        </p>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
@section('scripts')
@endsection
