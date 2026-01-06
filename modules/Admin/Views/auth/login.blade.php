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
            <div class="col-4 d-flex login-form-panel login-panel align-items-center justify-content-center">
                <div class="login-form">

                    <form action="{{ route('admin.login') }}" method="POST" class="row px-4" style="height: 30vh">
                        @csrf
                        <div class="title fw-bold py-3 h1">Admin Login</div>
                        <div class="form-group col-11 py-3">

                            <input id="my-input" placeholder="Enter Email..."
                                class="form-control p-2 border-0 border-bottom rounded-0" type="text" name="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group  col-11 py-3">

                            <input id="my-input" placeholder="Enter Password..."
                                class="form-control p-2 border-0 border-bottom rounded-0" type="text" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-11 mt-3">
                            <button type="submit" class="btn  btn-dark w-100 py-2 mt-3">Submit</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
@endsection
