@extends('layouts.main')
@section('title', 'Membership')
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
                            <h5>{{ __('Membership') }}</h5>
                            <span>{{ __('List of membership') }}</span>
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
                                <a href="#">{{ __('Membership') }}</a>
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
                                <h3>{{ __('Membership') }}</h3>
                            </div>
                            <div class="col-lg-4">
                                <a href="{{ url('member-plan/create') }}" type="button" class="btn btn-light"><i
                                        class="ik ik-plus"></i>{{ __('Add Membership') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="member_plan_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Phone Number') }}</th>
                                    <th>{{ __('Member Plan') }}</th>
                                    <th>{{ __('Date Enrolled') }}</th>
                                    <th>{{ __('Date Expiration') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Saskiya</td>
                                    <td>0877324342</td>
                                    <td>Basic Plan</td>
                                    <td>16/01/2024</td>
                                    <td>16/02/2024</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                            <a href="#"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Helena</td>
                                    <td>0856232335</td>
                                    <td>Basic Plan</td>
                                    <td>16/01/2024</td>
                                    <td>16/02/2024</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                            <a href="#"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bryan</td>
                                    <td>0858213121</td>
                                    <td>Basic Plan</td>
                                    <td>16/01/2024</td>
                                    <td>16/02/2024</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                            <a href="#"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </div>
                                    </td>
                                </tr>
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
        {{-- <script src="{{ asset('js/member-plan.js') }}"></script> --}}
    @endpush
@endsection
