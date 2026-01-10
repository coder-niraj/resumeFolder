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
                <div class="container"
                    style="height: 95vh;overflow-y: scroll; border-radius: 5px;border-top: 5px solid black;">
                    <div class="profile">
                        <div class="avatar py-5 px-3 d-flex align-items-center gap-3">
                            @if ($employeeObj->avatar)
                                <img src="{{ asset('storage/' . $employeeObj->avatar) }}" class="rounded-circle"
                                    width="120" height="120" alt="Avatar">
                            @else
                                <img src="https://static.vecteezy.com/system/resources/previews/013/360/247/non_2x/default-avatar-photo-icon-social-media-profile-sign-symbol-vector.jpg"
                                    class="rounded-circle" width="120" height="120">
                            @endif

                            <div class="name" style="line-height: 35px;">
                                <div class="fs-3">{{ $employeeObj->firstname . ' ' . $employeeObj->lastname }}</div>
                                <div>{{ $employeeObj->email }}</div>

                            </div>
                        </div>
                        <div class=" profile-details">
                            <form class="row p-3 g-3 needs-validation" novalidate action="{{ route('employee.update') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">First name</label>
                                    <input type="text" class="form-control input-bg " j
                                        value="{{ $employeeObj->firstname }}" name="firstname" required>
                                    @error('firstname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom02" class="form-label">Last name</label>
                                    <input type="text" class="form-control input-bg " j
                                        value="{{ $employeeObj->lastname }}" name="lastname" required>
                                    @error('lastname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom02" class="form-label">email</label>
                                    <input type="email" readonly class="form-control input-bg "
                                        value="{{ $employeeObj->email }}" name="email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom02" class="form-label">company name</label>
                                    <input type="text" class="form-control input-bg "
                                        value="{{ $employeeObj->company_name }}" name="company_name">
                                    @error('company_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom02" class="form-label">company website</label>
                                    <input type="text" class="form-control input-bg "
                                        value="{{ $employeeObj->company_website }}" name="company_website">
                                    @error('company_website')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom02" class="form-label">address</label>
                                    <input type="text" class="form-control input-bg "
                                        value="{{ $employeeObj->address }}" name="address">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom02" class="form-label">phone</label>
                                    <input type="number" class="form-control input-bg " value="{{ $employeeObj->phone }}"
                                        name="phone">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-6" style="position: relative;">
                                    <button class="btn btn-secondary "
                                        style="pointer-events: none; position: absolute;z-index: 0;">Choose
                                        Avatar</button>

                                    <input class="form-control " style="width: 130px; opacity: 0; z-index: 10;"
                                        type="file" name="avatar">

                                    @error('avatar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row py-5 px-1">

                                    <div class="col-3">
                                        <button class="btn btn-dark w-100">update</button>
                                    </div>
                                    <div class="col-3">
                                        <a href="{{ route('employee.password') }}" class="btn btn-dark w-100">
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
