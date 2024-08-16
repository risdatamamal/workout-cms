@extends('layouts.main')
@section('title', 'Add Experience Trainer')
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
                            <h5>{{ __('Add Experience Trainer') }}</h5>
                            <span>{{ __('Create new experience trainer') }}</span>
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
                                <a href="{{ route('experience-trainer.index', ['trainer_id' => $trainer_id]) }}">{{ __('Experience Trainer') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">{{ __('Add Experience Trainer') }}</a>
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
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <a href="{{ route('experience-trainer.index', ['trainer_id' => $trainer_id]) }}" type="button" class="btn btn-light">
                                    <i class="ik ik-arrow-left"></i>{{ __('Back') }}
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <h3>{{ __('Add Experience Trainer') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('experience-trainer.store', [ 'trainer_id' => $trainer_id ]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="trainer_id">{{ __('Trainer ID') }}<span class="text-red">*</span></label>
                                        <input id="trainer_id" type="text"
                                            class="form-control" name="trainer_id"
                                            value="{{ $trainer_id }}" placeholder="Enter trainer" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">{{ __('Company') }}<span class="text-red">*</span></label>
                                        <input id="company" type="text"
                                            class="form-control @error('company') is-invalid @enderror" name="company"
                                            value="{{ old('company') }}" placeholder="Enter company (Example: Gold Gym)" required>
                                        <div class="help-block with-errors"></div>

                                        @error('company')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year">{{ __('Year') }}<span class="text-red">*</span></label>
                                        <input id="year" type="text"
                                            class="form-control @error('year') is-invalid @enderror" name="year"
                                            value="{{ old('year') }}" placeholder="Enter year (Example: 2020-2021)" required>
                                        <div class="help-block with-errors"></div>

                                        @error('year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="position">{{ __('Position') }}<span class="text-red">*</span></label>
                                        <input id="position" type="text"
                                            class="form-control @error('position') is-invalid @enderror" name="position"
                                            value="{{ old('position') }}" placeholder="Enter position (Example: Aerobic Trainer)" required>
                                        <div class="help-block with-errors"></div>

                                        @error('position')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
