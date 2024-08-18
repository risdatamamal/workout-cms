@extends('layouts.main')
@section('title', 'Speciality Trainer')
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
                        <i class="ik ik-award bg-success"></i>
                        <div class="d-inline">
                            <h5>{{ __('Speciality Trainer - ' . $trainer->user->name) }}</h5>
                            <span>{{ __('List of speciality trainer - ' . $trainer->user->name) }}</span>
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
                                <a href="javascript:void(0)">{{ __('Speciality Trainer') }}</a>
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
                            <div class="col-lg-5">
                                <h3>{{ __('Speciality Trainer') }}</h3>
                            </div>
                            <div class="col-lg-7">
                                <a href="{{ url('trainer') }}" type="button" class="btn btn-light">
                                    <i class="ik ik-arrow-left"></i>{{ __('Back') }}
                                </a>
                                <a href="{{ route('speciality-trainer.create', ['trainer_id' => $trainer->id]) }}"
                                    type="button" class="btn btn-light"><i class="ik ik-plus"></i>{{ __('Add') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="sp_trainer_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
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
        <!--server side speciality trainer table script-->
        <script src="{{ asset('js/speciality-trainer.js') }}"></script>
    @endpush
@endsection
