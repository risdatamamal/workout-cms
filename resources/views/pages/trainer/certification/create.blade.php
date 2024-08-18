@extends('layouts.main')
@section('title', 'Add Certification Trainer')
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
                        <i class="ik ik-file-text bg-success"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add Certification Trainer') }}</h5>
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
                                <a href="{{ route('experience-trainer.index', ['trainer_id' => $trainer_id]) }}">{{ __('Certification Trainer') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">{{ __('Add Certification Trainer') }}</a>
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
                                <h3>{{ __('Add Certification Trainer') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('certification-trainer.store', [ 'trainer_id' => $trainer_id ]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group" hidden>
                                        <label for="trainer_id">{{ __('Trainer ID') }}<span class="text-red">*</span></label>
                                        <input id="trainer_id" type="text"
                                            class="form-control" name="trainer_id"
                                            value="{{ $trainer_id }}" placeholder="Enter trainer" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}<span class="text-red">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" placeholder="Enter name (Example: Indonesia Aerobic and Fitness Association)" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code_name">{{ __('Code Name') }}<span class="text-red">*</span></label>
                                        <input id="code_name" type="text"
                                            class="form-control @error('code_name') is-invalid @enderror" name="code_name"
                                            value="{{ old('code_name') }}" placeholder="Enter code name (Example: IAFA)" required>
                                        <div class="help-block with-errors"></div>

                                        @error('code_name')
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
