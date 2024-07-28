@extends('layouts.main')
@section('title', 'Profile')
@section('content')


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-success"></i>
                        <div class="d-inline">
                            <h5>{{ __('Profile')}}</h5>
                            <span>{{ __('Show and edit your profile account')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="../img/user.jpg" class="rounded-circle" width="150" />
                            <h4 class="card-title mt-10">{{ Auth()->user()->name }}</h4>
                            @if(Auth()->user()->getRoleNames()->count() > 0)
                                <p class="card-subtitle">{{ Auth()->user()->getRoleNames()->implode(', ') }}</p>
                            @else
                                <p class="card-subtitle">{{ __('No roles assigned') }}</p>
                            @endif
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block">{{ __('Email address')}} </small>
                        <h6>{{ Auth()->user()->email }}</h6>
                        <small class="text-muted d-block pt-10">{{ __('Phone Number')}}</small>
                        <h6>{{ Auth()->user()->phone_number ?? 'empty' }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Profile')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">{{ __('Setting')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-6"> <strong>{{ __('Full Name')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ Auth()->user()->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Phone Number')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ Auth()->user()->phone_number ?? 'empty' }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Email')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ Auth()->user()->email }}</p>
                                    </div>
                                    {{-- <div class="col-md-3 col-6"> <strong>{{ __('Location')}}</strong>
                                        <br>
                                        <p class="text-muted">London</p>
                                    </div> --}}
                                </div>
                                {{-- <hr>
                                <p class="mt-30">{{ __('Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.')}}</p> --}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="name">{{ __('Full Name')}}</label>
                                        <input type="text" placeholder="Enter name" class="form-control" name="name" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email')}}</label>
                                        <input type="email" placeholder="Enter email address" class="form-control" name="email" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ __('Password')}}</label>
                                        <input type="password" placeholder="Enter your password" value="password" class="form-control" name="password" id="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">{{ __('Phone Number')}}</label>
                                        <input type="text" placeholder="Enter phone number" id="phone_number" name="phone_number" class="form-control">
                                    </div>
                                    <button class="btn btn-success" type="submit">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
