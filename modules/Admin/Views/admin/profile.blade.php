@extends('admin::layouts.app')
@section('title', 'admin-login')
@section('header')
@endsection
@section('style')
@endsection
@section('content')
    <div class="d-flex">
        <div class="">
            @include('admin::components.sidebar', ['active' => 'profile'])
        </div>
        <div class="w-100 input-bg">
            <div class="m-3 bg-white">
                <div class="container " style="height: 95vh;border-radius: 5px;border-top: 5px solid black;">
                    <div class="profile">
                        <div class="avatar py-5 px-3 d-flex align-items-center gap-3">

                            <img src="{{ asset('storage/' . $adminObj->avatar) }}" class="rounded-circle" width="120"
                                height="120" alt="Avatar">

                            <div class="name" style="line-height: 35px;">
                                <div class="fs-3">{{ $adminObj->firstname . ' ' . $adminObj->lastname }}</div>
                                <div>{{ $adminObj->email }}</div>

                            </div>
                        </div>
                        <div class=" profile-details ">
                            <form class="row p-3 g-3 needs-validation" novalidate action="{{ route('admin.update') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">First name</label>
                                    <input type="text" class="form-control input-bg " value="{{ $adminObj->firstname }}"
                                        name="firstname" required>
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom02" class="form-label">Last name</label>
                                    <input type="text" class="form-control input-bg " value="{{ $adminObj->lastname }}"
                                        name="lastname" required>
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom02" class="form-label">email</label>
                                    <input type="email" readonly class="form-control input-bg "
                                        value="{{ $adminObj->email }}" name="email">
                                </div>


                                <div class="col-6" style="position: relative;">
                                    <button class="btn btn-secondary "
                                        style="pointer-events: none; position: absolute;z-index: 0;">Choose
                                        Avatar</button>

                                    <input class="form-control " style="width: 130px; opacity: 0; z-index: 10;"
                                        type="file" name="avatar">

                                </div>
                                <div class="row py-5 px-1">

                                    <div class="col-3">
                                        <button class="btn btn-dark w-100">update</button>
                                    </div>
                                    <div class="col-3">
                                        <a href="{{ route('admin.password') }}" class="btn btn-dark w-100">
                                            change password
                                        </a>
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
