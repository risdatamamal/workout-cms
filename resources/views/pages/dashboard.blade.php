@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="profile-pic mb-20">
                            <img src="../img/user.jpg" width="150" class="rounded-circle" alt="user">
                            <h5 class="mt-20 mb-0">Welcome, {{ Auth()->user()->name }}</h5>
                            <p>Enjoy your day and lets get the work done</p>
                        </div>
                        @if (Auth()->user()->getRoleNames()->count() > 0)
                            <div class="badge badge-pill badge-dark">{{ Auth()->user()->getRoleNames()->implode(', ') }}
                            </div>
                        @else
                            <div class="badge badge-pill badge-dark">Admin</div>
                        @endif
                    </div>
                    <div class="p-4 border-top mt-15">
                        <div class="row text-center">
                            <div class="col-6 border-right">
                                <a class="link d-flex align-items-center justify-content-center"><i
                                        class="ik ik-message-square f-20 mr-5"></i>Email</a>
                            </div>
                            <div class="col-6">
                                <a
                                    class="link d-flex align-items-center justify-content-center disabled">{{ Auth::user()->email }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div id="datepickerwidget"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div id="card-412" class="card">
                    <div class="card-header">
                        <h3>Class Today</h3>
                    </div>
                    <div class="card-body">
                        <ul class="task-list">
                            <li class="list">
                                <span></span>
                                <div class="task-details">
                                    <p class="date">
                                        <small class="text-primary">Class</small> - By Jonathan
                                    </p>
                                    <p>Yoga</p>
                                    <small>Scheduled for 16/01/2024 10:00 AM</small>
                                </div>
                            </li>
                            <li class="list">
                                <span></span>
                                <div class="task-details">
                                    <p class="date">
                                        <small class="text-primary">Class</small> - By Jonathan
                                    </p>
                                    <p>Zumba</p>
                                    <small>Scheduled for 16/01/2024 20:00 PM</small>
                                </div>
                            </li>
                            <li class="list completed">
                                <span></span>
                                <div class="task-details">
                                    <p class="date">
                                        <small class="text-primary">Class</small> - By Sarah
                                    </p>
                                    <p>Yoga</p>
                                    <small>Completed 2 days ago</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card new-cust-card">
                    <div class="card-header">
                        <h3>{{ __('New Trainers') }}</h3>
                    </div>
                    <div class="card-block">
                        <div class="align-middle mb-25">
                            <img src="../img/users/1.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>{{ __('Jonathan') }}</h6>
                                </a>
                                <p class="text-muted mb-0">{{ __('Zumba') }}</p>
                                <span class="status deactive text-mute"><i
                                        class="far fa-clock mr-10"></i>{{ __('30 min ago') }}</span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <img src="../img/users/2.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>{{ __('Clarissa') }}</h6>
                                </a>
                                <p class="text-muted mb-0">{{ __('Yoga') }}</p>
                                <span class="status deactive text-mute"><i
                                        class="far fa-clock mr-10"></i>{{ __('45 min ago') }}</span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <img src="../img/users/3.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>{{ __('Tina') }}</h6>
                                </a>
                                <p class="text-muted mb-0">{{ __('Yoga') }}</p>
                                <span class="status deactive text-mute"><i
                                        class="far fa-clock mr-10"></i>{{ __('1 hrs ago') }}</span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <img src="../img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>{{ __('John Doue') }}</h6>
                                </a>
                                <p class="text-muted mb-0">{{ __('Zumba') }}</p>
                                <span class="status deactive text-mute"><i
                                        class="far fa-clock mr-10"></i>{{ __('3 hrs ago') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-6">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('Active Members') }}</h3>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Profile') }}</th>
                                        <th>{{ __('Customer Name') }}</th>
                                        <th>{{ __('Date Paid') }}</th>
                                        <th>{{ __('Date Expiry') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="../img/users/4.jpg" alt="" class="img-fluid img-40"></td>
                                        <td>{{ __('Saskiya') }}</td>
                                        <td>{{ __('16/01/2024') }}</td>
                                        <td>{{ __('16/08/2024') }}</td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="../img/users/3.jpg" alt="" class="img-fluid img-40"></td>
                                        <td>{{ __('Helena') }}</td>
                                        <td>{{ __('22/01/2024') }}</td>
                                        <td>{{ __('22/01/2025') }}</td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="../img/users/5.jpg" alt="" class="img-fluid img-40"></td>
                                        <td>{{ __('John Elmar Rodrigo') }}</td>
                                        <td>{{ __('16/01/2024') }}</td>
                                        <td>{{ __('16/01/2024') }}</td>
                                        <td>
                                            <div class="p-status bg-danger"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

        <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>

        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>

        <script src="{{ asset('plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap.min.js') }}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('js/widgets.js') }}"></script>
    @endpush
@endsection
