@extends('layouts.main')
@section('title', 'Class')
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
                        <i class="ik ik-check-circle bg-success"></i>
                        <div class="d-inline">
                            <h5>{{ __('Class') }}</h5>
                            <span>{{ __('List of class') }}</span>
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
                                <a href="#">{{ __('Class') }}</a>
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
                                <h3>{{ __('Class') }}</h3>
                            </div>
                            <div class="col-lg-4">
                                <a href="{{ url('class/create') }}" type="button" class="btn btn-light"><i
                                        class="ik ik-plus"></i>{{ __('Add Class') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="classes_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Class') }}</th>
                                    <th>{{ __('Trainer') }}</th>
                                    <th>{{ __('Duration') }}</th>
                                    <th>{{ __('Level') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Capacity') }}</th>
                                    <th>{{ __('Calori Burn') }}</th>
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
        <!--server side class table script-->
        <script src="{{ asset('js/classes.js') }}"></script>
    @endpush
@endsection
