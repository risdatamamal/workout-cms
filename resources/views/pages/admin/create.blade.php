@extends('layouts.main')
@section('title', 'Add Admin')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-success"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add Admin') }}</h5>
                            <span>{{ __('Create new admin, assign roles & permissions') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Add Admin') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('includes.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <a href="{{ url('admin') }}" type="button" class="btn btn-light">
                                    <i class="ik ik-arrow-left"></i>{{ __('Back') }}
                                </a>
                            </div>
                            <div class="col-lg-7">
                                <h3>{{ __('Add Admin') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('store-admin') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}<span class="text-red">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" placeholder="Enter name" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}<span class="text-red">*</span></label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" placeholder="Enter email address" required>
                                        <div class="help-block with-errors"></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}<span class="text-red">*</span></label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Enter password" required>
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password') }}<span
                                                class="text-red">*</span></label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" placeholder="Retype password" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province_id">{{ __('Assign Province') }}</label>
                                        <select class="form-control select2" name="province_id" id="province_id">
                                            <option value="0">Select Province</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="regency_id">{{ __('Assign Regency') }}</label>
                                        <select class="form-control select2" name="regency_id" id="regency_id">
                                            <option value="0">Select Regency</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">{{ __('Assign Role') }}<span
                                                class="text-red">*</span></label>
                                        {!! Form::select('role', $roles, null, [
                                            'class' => 'form-control select2',
                                            'placeholder' => 'Select Role',
                                            'id' => 'role',
                                            'required' => 'required',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="role">{{ __('Permissions') }}</label>
                                        <div id="permission" class="form-group" style="border-left: 2px solid #d1d1d1;">
                                            <span class="badge text-red m-1">Select role first</span>
                                        </div>
                                        <input type="hidden" id="token" name="token"
                                            value="{{ csrf_token() }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/get-role.js') }}"></script>
        <script src="{{ asset('js/get-regency.js') }}"></script>
    @endpush
@endsection
