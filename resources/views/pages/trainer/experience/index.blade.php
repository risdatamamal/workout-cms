@extends('layouts.main')
@section('title', 'Experience Trainer')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-pocket bg-success"></i>
                        <div class="d-inline">
                            <h5>{{ __('Experience Trainer - ' . $trainer->user->name) }}</h5>
                            <span>{{ __('List of experience trainer - ' . $trainer->user->name ) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('trainer') }}">{{ __('Trainer') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">{{ __('Experience Trainer') }}</a>
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
                <div class="card p-3">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h3>{{ __('Experience Trainer') }}</h3>
                            </div>
                            <div class="col-lg-4">
                                <a href="{{ route('experience-trainer.create', [ 'trainer_id' => $trainer->id]) }}" type="button" class="btn btn-light"><i
                                        class="ik ik-plus"></i>{{ __('Add Experience Trainer') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="exp_trainer_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Year') }}</th>
                                    <th>{{ __('Company') }}</th>
                                    <th>{{ __('Position') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <!--server side experience trainer table script-->
        <script src="{{ asset('js/experience-trainer.js') }}"></script>
    @endpush
@endsection
