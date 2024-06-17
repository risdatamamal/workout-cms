@extends('layouts.main')
@section('title', 'Organization')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-globe bg-green"></i>
                        <div class="d-inline">
                            <h5>{{ __('Organization') }}</h5>
                            <span>{{ __('Profile Organization of MY GYM') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <i class="ik ik-home mr-2"></i>{{ __('Organization') }}
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('organizations/all') }}" class="text-success">{{ __('See all') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            @include('includes.message')
            <div class="col-sm">
                <div class="card card-green st-cir-card text-white" type="button" data-toggle="modal"
                    data-target="#inputBiodata">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-center">
                                <i class="ik ik-user f-60"></i>
                                <h6 class="mt-3">Biodata</h6>
                            </div>
                        </div>
                        <span class="st-bt-lbl"><i class="ik ik-plus-circle"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-green st-cir-card text-white" type="button" data-toggle="modal"
                    data-target="#inputManagement">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-center">
                                <i class="ik ik-layers f-60"></i>
                                <h6 class="mt-3">Management</h6>
                            </div>
                        </div>
                        <span class="st-bt-lbl"><i class="ik ik-plus-circle"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-green st-cir-card text-white" type="button" data-toggle="modal"
                    data-target="#inputInfrastructure">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-center">
                                <i class="ik ik-bookmark f-60"></i>
                                <h6 class="mt-3">Infrastructure</h6>
                            </div>
                        </div>
                        <span class="st-bt-lbl"><i class="ik ik-plus-circle"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-green st-cir-card text-white" type="button" data-toggle="modal"
                    data-target="#inputActivity">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-center">
                                <i class="ik ik-inbox f-60"></i>
                                <h6 class="mt-3">Activity</h6>
                            </div>
                        </div>
                        <span class="st-bt-lbl"><i class="ik ik-plus-circle"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-green st-cir-card text-white" type="button" data-toggle="modal"
                    data-target="#inputAchievement">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col text-center">
                                <i class="ik ik-star f-60"></i>
                                <h6 class="mt-3">Achievement</h6>
                            </div>
                        </div>
                        <span class="st-bt-lbl"><i class="ik ik-plus-circle"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ $biodata->logo_path ? Storage::url($biodata->logo_path) : asset('img/user.jpg') }}"
                                class="rounded-circle" width="150" />
                            <h4 class="card-title mt-10">{{ Auth::user()->name }}</h4>
                            @if (Auth::user()->is_active)
                                <div class="row text-center justify-content-center">
                                    <i class="ik ik-check-circle text-green mr-1"></i>
                                    <p class="card-subtitle text-green">{{ __('Active') }}</p>
                                </div>
                            @else
                                <div class="row text-center justify-content-center">
                                    <i class="ik ik-x-circle text-red mr-1"></i>
                                    <p class="card-subtitle text-red">{{ __('Inactive') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="p-4 border-top border-bottom mt-5">
                        <div class="row text-center">
                            <div class="col-4 border-right">
                                <div class="col justify-content-center">
                                    <div class="link d-flex align-items-center justify-content-center">
                                        <span>{{ $biodata->sk_no ?? 'NULL' }}</span>
                                    </div>
                                    <div class="link d-flex align-items-center justify-content-center">
                                        <span><strong>SK No.</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 border-right">
                                <div class="col justify-content-center">
                                    <div class="link d-flex align-items-center justify-content-center">
                                        <span>
                                            @if ($biodata->sk_date)
                                                {{ date('d/m/Y', strtotime($biodata->sk_date)) }}
                                            @else
                                                NULL
                                            @endif
                                        </span>
                                    </div>
                                    <div class="link d-flex align-items-center justify-content-center">
                                        <span><strong>SK Date</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="link d-flex align-items-center justify-content-center">
                                    <span>
                                        @if ($biodata->sk_valid_period)
                                            {{ date('d/m/Y', strtotime($biodata->sk_valid_period)) }}
                                        @else
                                            NULL
                                        @endif
                                    </span>
                                </div>
                                <div class="link d-flex align-items-center justify-content-center">
                                    <span><strong>Valid Period</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6><strong>Basic Info</strong></h6>
                        <small class="text-muted d-block pt-10">{{ __('Address') }}</small>
                        <h6>{{ $biodata->address ?? 'NULL' }}</h6>
                        <small class="text-muted d-block pt-10">{{ __('Chairman') }} </small>
                        <h6>{{ $biodata->chairman ?? 'NULL' }}</h6>
                        <div class="pt-20">
                            <button type="button" class="btn btn-outline-success btn-rounded" data-toggle="modal"
                                data-target="#inputChangePassword">{{ __('Change Password') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-biodata-tab" data-toggle="pill" href="#biodata"
                                role="tab" aria-controls="pills-biodata" aria-selected="false"><i
                                    class="ik ik-user mr-2"></i>{{ __('Biodata') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-management-tab" data-toggle="pill" href="#management"
                                role="tab" aria-controls="pills-management" aria-selected="false"><i
                                    class="ik ik-layers mr-2"></i>{{ __('Management') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-infrastructure-tab" data-toggle="pill" href="#infrastructure"
                                role="tab" aria-controls="pills-infrastructure" aria-selected="false"><i
                                    class="ik ik-bookmark mr-2"></i>{{ __('Infrastructure') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-activity-tab" data-toggle="pill" href="#activity"
                                role="tab" aria-controls="pills-activity" aria-selected="false"><i
                                    class="ik ik-inbox mr-2"></i>{{ __('Activity') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-achievement-tab" data-toggle="pill" href="#achievement"
                                role="tab" aria-controls="pills-achievement" aria-selected="true"><i
                                    class="ik ik-star mr-2"></i>{{ __('Achievement') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="biodata" role="tabpanel"
                            aria-labelledby="pills-biodata-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-6"> <strong>{{ __('Organization Name') }}</strong>
                                        <br>
                                        <p class="text-muted">{{ $biodata->name ?? 'NULL' }}</p>
                                    </div>
                                    <div class="col-md-4 col-6"> <strong>{{ __('Address') }}</strong>
                                        <br>
                                        <p class="text-muted">{{ $biodata->address ?? 'NULL' }}</p>
                                    </div>
                                    <div class="col-md-4 col-6"> <strong>{{ __('Email') }}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->email ?? 'NULL' }}</p>
                                    </div>
                                    <div class="col-md-4 col-6"> <strong>{{ __('Contact Person') }}</strong>
                                        <br>
                                        <p class="text-muted">{{ $biodata->contact_person_name ?? 'NULL' }}</p>
                                    </div>
                                    <div class="col-md-4 col-6"> <strong>{{ __('Contact Person Number') }}</strong>
                                        <br>
                                        <p class="text-muted">{{ $biodata->contact_person_no ?? 'NULL' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="management" role="tabpanel"
                            aria-labelledby="pills-management-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>{{ __('Position') }}</th>
                                                        <th>{{ __('Name') }}</th>
                                                        <th>{{ __('Phone') }}</th>
                                                        <th>{{ __('Photo Profile') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($managements as $management)
                                                        <tr>
                                                            <td>{{ $management->position_name }}</td>
                                                            <td>{{ $management->stakeholder_name }}</td>
                                                            <td>{{ $management->phone_number ?? '-' }}</td>
                                                            <td>
                                                                @if ($management->photo_profile_path != null)
                                                                    <button type="button"
                                                                        class="btn btn-outline-success btn-rounded"
                                                                        data-toggle="modal"
                                                                        data-target="#viewImageManagement">{{ __('View') }}</button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ url('management/delete', $management->id) }}"
                                                                    class="btn btn-outline-danger btn-rounded">{{ __('Delete') }}</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center">
                                                                {{ __('No data available') }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="infrastructure" role="tabpanel"
                            aria-labelledby="pills-infrastructure-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>{{ __('Sarpras Name') }}</th>
                                                        <th>{{ __('Total') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        <th>{{ __('Procurement Date') }}</th>
                                                        <th>{{ __('Sarpras Photo') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($infrastructures as $infrastructure)
                                                        <tr>
                                                            <td>{{ $infrastructure->sarpras_name }}</td>
                                                            <td>{{ $infrastructure->total }}</td>
                                                            <td>{{ $infrastructure->good_status }} Good,
                                                                {{ $infrastructure->damage_status }} Damage</td>
                                                            <td>{{ date('d/m/Y', strtotime($infrastructure->procurement_date)) }}
                                                            </td>
                                                            <td>
                                                                @if ($infrastructure->photo_sarpras_path != null)
                                                                    <button type="button"
                                                                        class="btn btn-outline-success btn-rounded"
                                                                        data-toggle="modal"
                                                                        data-target="#viewImageInfra">{{ __('View') }}</button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ url('infrastructure/delete', $infrastructure->id) }}"
                                                                    class="btn btn-outline-danger btn-rounded">{{ __('Delete') }}</a>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                {{ __('No data available') }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="activity" role="tabpanel"
                            aria-labelledby="pills-activity-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>{{ __('Activity Name') }}</th>
                                                        <th>{{ __('Date') }}</th>
                                                        <th>{{ __('Description') }}</th>
                                                        <th>{{ __('Activity Photo') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($activities as $activity)
                                                        <tr>
                                                            <td>{{ $activity->activity_name }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($activity->activity_date)) }}
                                                            </td>
                                                            <td>{{ $activity->activity_desc ?? '-' }}</td>
                                                            <td>
                                                                @if ($activity->photo_activity_path != null)
                                                                    <button type="button"
                                                                        class="btn btn-outline-success btn-rounded"
                                                                        data-toggle="modal"
                                                                        data-target="#viewImageActivity">{{ __('View') }}</button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ url('activity/delete', $activity->id) }}"
                                                                    class="btn btn-outline-danger btn-rounded">{{ __('Delete') }}</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center">
                                                                {{ __('No data available') }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="achievement" role="tabpanel"
                            aria-labelledby="pills-achievement-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>{{ __('Championship Name') }}</th>
                                                        <th>{{ __('Date') }}</th>
                                                        <th>{{ __('Medal') }}</th>
                                                        <th>{{ __('Category') }}</th>
                                                        <th>{{ __('Class') }}</th>
                                                        <th>{{ __('Photo') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($achievements as $achievement)
                                                        <tr>
                                                            <td>{{ $achievement->championship_name }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($achievement->championship_date)) }}
                                                            </td>
                                                            <td>
                                                                @if ($achievement->medal == 'gold')
                                                                    <img height="25"
                                                                        src="{{ asset('img/medal/gold.png') }}"
                                                                        alt="Gold Medal">
                                                                @elseif ($achievement->medal == 'silver')
                                                                    <img height="25"
                                                                        src="{{ asset('img/medal/silver.png') }}"
                                                                        alt="Silver Medal">
                                                                @elseif ($achievement->medal == 'bronze')
                                                                    <img height="25"
                                                                        src="{{ asset('img/medal/bronze.png') }}"
                                                                        alt="Bronze Medal">
                                                                @endif
                                                            </td>
                                                            <td>{{ strtoupper($achievement->category) }}</td>
                                                            <td>{{ ucfirst($achievement->class) }} -
                                                                {{ ucfirst($achievement->class_level) }}
                                                                {{ ucfirst($achievement->class_gender) }}</td>
                                                            <td>
                                                                @if ($achievement->supporting_photos_path != null)
                                                                    <button type="button"
                                                                        class="btn btn-outline-success btn-rounded"
                                                                        data-toggle="modal"
                                                                        data-target="#viewImageAchievement">{{ __('View') }}</button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ url('achievement/delete', $achievement->id) }}"
                                                                    class="btn btn-outline-danger btn-rounded">{{ __('Delete') }}</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center">
                                                                {{ __('No data available') }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('pages.organizations.modal-input')

        @include('pages.organizations.modal-image')

    </div>

    @push('script')
        <script src="{{ asset('js/organization.js') }}"></script>
        <script>
            function confirmUpdate() {
                return confirm('Are you sure you want to update data?');
            }
        </script>
        <script>
            function previewImageBiodata() {
                const logo_path = document.querySelector('#logo_path')
                const imagePreview = document.querySelector('#logo-preview')

                const imageFile = new FileReader()
                imageFile.readAsDataURL(logo_path.files[0])

                imageFile.onload = (e) => (imagePreview.src = e.target.result)
            }
        </script>
        <script>
            function previewImageManagement() {
                const photoProfilePath = document.querySelector('#photo_profile_path')
                const imagePreview = document.querySelector('#photo-profile-preview')

                const imageFile = new FileReader()
                imageFile.readAsDataURL(photoProfilePath.files[0])

                imageFile.onload = (e) => (imagePreview.src = e.target.result)
            }
        </script>
        <script>
            function previewImageSarpras() {
                const photoSarprasPath = document.querySelector('#photo_sarpras_path')
                const imagePreview = document.querySelector('#photo-sarpras-preview')

                const imageFile = new FileReader()
                imageFile.readAsDataURL(photoSarprasPath.files[0])

                imageFile.onload = (e) => (imagePreview.src = e.target.result)
            }
        </script>
        <script>
            function previewImageActivity() {
                const photoActivityPath = document.querySelector('#photo_activity_path')
                const imagePreview = document.querySelector('#photo-activity-preview')

                const imageFile = new FileReader()
                imageFile.readAsDataURL(photoActivityPath.files[0])

                imageFile.onload = (e) => (imagePreview.src = e.target.result)
            }
        </script>
        <script>
            function previewImageAchievement() {
                const photoAchievementPath = document.querySelector('#supporting_photos_path')
                const imagePreview = document.querySelector('#photo-achievement-preview')

                const imageFile = new FileReader()
                imageFile.readAsDataURL(photoAchievementPath.files[0])

                imageFile.onload = (e) => (imagePreview.src = e.target.result)
            }
        </script>
    @endpush
@endsection
