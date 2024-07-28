@extends('layouts.main')
@section('title', 'Edit Member Plan')
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
                            <h5>{{ __('Edit Member Plan') }}</h5>
                            <span>{{ __('Create new member plan') }}</span>
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
                                <a href="javascript:void(0)">{{ __('Edit Member Plan') }}</a>
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
                            <div class="col-lg-4">
                                <a href="{{ url('member-plan') }}" type="button" class="btn btn-light">
                                    <i class="ik ik-arrow-left"></i>{{ __('Back') }}
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <h3>{{ __('Edit Member Plan') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('member-plan/update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $memberPlan->id }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}<span class="text-red">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ clean($memberPlan->name, 'name') }}" placeholder="Enter name" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}<span class="text-red">*</span></label>
                                        <input id="description" type="text"
                                            class="form-control @error('description') is-invalid @enderror" name="description"
                                            value="{{ clean($memberPlan->description, 'description') }}" placeholder="Enter description" required>
                                        <div class="help-block with-errors"></div>

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price_monthly">{{ __('Price Monthly') }}<span class="text-red">*</span></label>
                                        <input id="price_monthly" type="number"
                                            class="form-control @error('price_monthly') is-invalid @enderror" name="price_monthly"
                                            value="{{ clean($memberPlan->price_monthly, 'price_monthly') }}" placeholder="Enter price monthly" required>
                                        <div class="help-block with-errors"></div>

                                        @error('price_monthly')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="duration">{{ __('Duration') }}<span class="text-red">*</span></label>
                                        <input id="duration" type="number"
                                            class="form-control @error('duration') is-invalid @enderror" name="duration"
                                            value="{{ clean($memberPlan->duration, 'duration') }}" placeholder="Enter duration" required>
                                        <div class="help-block with-errors"></div>

                                        @error('duration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="is_active">{{ __('Active') }}</label>
                                        <label class="switch">
                                            <input id="is_active" type="checkbox" name="is_active" value="1">
                                            <span class="slider round"></span>
                                        </label>
                                    </div> --}}
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
