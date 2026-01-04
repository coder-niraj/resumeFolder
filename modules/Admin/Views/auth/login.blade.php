@extends('admin::layouts.app')
@section('title', 'admin-login')
@section('header')
@endsection
@section('style')
@endsection
@section('content')

    <div class="m-5">
        <div class="row shadow-lg" style="height: 85vh;">
            <div class="col-8 my-bg"></div>
            <div class="col-4 d-flex align-items-center justify-content-center">
               
                <form action="{{ route('admin.login.api') }}" method="POST" class="row px-4" style="height: 30vh">
                    @csrf
                    <div class="title fw-bold py-3 h3">Login</div>
                    <div class="form-group col-11">
                        <label for="my-input">Email</label>
                        <input id="my-input" class="form-control p-2 my-2" type="text" name="email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group  col-11">
                        <label for="my-input">Password</label>
                        <input id="my-input" class="form-control p-2 my-2" type="text" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-11">
                        <button type="submit" class="btn my-2 btn-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
@endsection
