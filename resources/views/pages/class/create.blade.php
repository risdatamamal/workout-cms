@extends('layouts.main')
@section('title', 'Add Class')
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
                            <h5>{{ __('Add Class') }}</h5>
                            <span>{{ __('Create new class, assign trainer') }}</span>
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
                                <a href="#">{{ __('Add Class') }}</a>
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
                                <a href="{{ url('class') }}" type="button" class="btn btn-light">
                                    <i class="ik ik-arrow-left"></i>{{ __('Back') }}
                                </a>
                            </div>
                            <div class="col-lg-7">
                                <h3>{{ __('Add Class') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('store-class') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="speciality_id">{{ __('Class Name') }}<span
                                                class="text-red">*</span></label>
                                        <select class="form-control select2" name="speciality_id" id="speciality_id">
                                            <option selected disabled>Select Class Name</option>
                                            @foreach ($specialites as $speciality)
                                                <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">{{ __('Description') }}</label>
                                        <input id="desc" type="text"
                                            class="form-control @error('desc') is-invalid @enderror" name="desc"
                                            value="{{ old('desc') }}" placeholder="Enter description">
                                        <div class="help-block with-errors"></div>

                                        @error('desc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">{{ __('Type') }}<span
                                                        class="text-red">*</span></label>
                                                <select class="form-control select2" name="type" id="type">
                                                    <option>Select Type</option>
                                                    <option value="Mind & Body">Mind & Body</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="calories_burn">{{ __('Calories Burn') }}<span
                                                        class="text-red">*</span></label>
                                                <input id="calories_burn" type="number"
                                                    class="form-control @error('calories_burn') is-invalid @enderror"
                                                    name="calories_burn" value="{{ old('calories_burn') }}"
                                                    placeholder="Enter calories burn" required>
                                                <div class="help-block with-errors"></div>

                                                @error('calories_burn')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="trainer_id">{{ __('Trainer') }}<span
                                                class="text-red">*</span></label>
                                        <select class="form-control select2" name="trainer_id" id="trainer_id">
                                            <option value="">Select Trainer</option>
                                            @foreach ($trainers as $trainer)
                                                <option value="{{ $trainer->id }}">{{ $trainer->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="capacity">{{ __('Capacity') }}<span
                                                        class="text-red">*</span></label>
                                                <input id="capacity" type="number"
                                                    class="form-control @error('capacity') is-invalid @enderror"
                                                    name="capacity" value="{{ old('capacity') }}"
                                                    placeholder="Enter capacity" required>
                                                <div class="help-block with-errors"></div>

                                                @error('capacity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="level">{{ __('Level') }}<span
                                                        class="text-red">*</span></label>
                                                <select class="form-control select2" name="level" id="level">
                                                    <option>Select Level</option>
                                                    <option value="easy">Easy</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="advanced">Advanced</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duration">{{ __('Duration (Minutes)') }}<span
                                                        class="text-red">*</span></label>
                                                <input id="duration" type="number"
                                                    class="form-control @error('duration') is-invalid @enderror"
                                                    name="duration" value="{{ old('duration') }}"
                                                    placeholder="Enter duration" required>
                                                <div class="help-block with-errors"></div>

                                                @error('duration')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
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
