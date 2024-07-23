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
                            <h5 class="mt-20 mb-0">Welcome, John Doe</h5>
                            <p>Enjoy your day and lets get the work done</p>
                        </div>
                        <div class="badge badge-pill badge-dark">Admin</div>
                    </div>
                    <div class="p-4 border-top mt-15">
                        <div class="row text-center">
                            <div class="col-6 border-right">
                                <a class="link d-flex align-items-center justify-content-center"><i
                                        class="ik ik-message-square f-20 mr-5"></i>Email</a>
                            </div>
                            <div class="col-6">
                                <a class="link d-flex align-items-center justify-content-center disabled">{{ Auth::user()->email }}</a>
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
                        <div class="card-header-right">
                            {{-- <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="task-list">
                            <li class="list">
                                <span></span>
                                <div class="task-details">
                                    <p class="date">
                                        <small class="text-primary">Meeting</small> - Upcoming in 5 days
                                    </p>
                                    <p>Meeting with Sara in the Caffee Caldo for Brunch</p>
                                    <small>Scheduled for 16th Mar, 2017</small>
                                </div>
                            </li>
                            <li class="list">
                                <span></span>
                                <div class="task-details">
                                    <p class="date">
                                        <small class="text-primary">Meeting</small> - Delay 7 days
                                    </p>
                                    <p>Technical management meeting</p>
                                    <small>Completed 15 days ago</small>
                                </div>
                            </li>
                            <li class="list completed">
                                <span></span>
                                <div class="task-details">
                                    <p class="date">
                                        <small class="text-danger">Transfer</small> - Completed
                                    </p>
                                    <p>Transfer all domain names as soon as possible!</p>
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
                        <div class="card-header-right">
                            {{-- <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul> --}}
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="align-middle mb-25">
                            <img src="../img/users/1.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>{{ __('Alex Thompson') }}</h6>
                                </a>
                                <p class="text-muted mb-0">{{ __('Cheers!') }}</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <img src="../img/users/2.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>{{ __('John Doue') }}</h6>
                                </a>
                                <p class="text-muted mb-0">{{ __('stay hungry stay foolish!') }}</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <img src="../img/users/3.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>{{ __('Alex Thompson') }}</h6>
                                </a>
                                <p class="text-muted mb-0">{{ __('Cheers!') }}</p>
                                <span class="status deactive text-mute"><i
                                        class="far fa-clock mr-10"></i>{{ __('30 min ago') }}</span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <img src="../img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>{{ __('John Doue') }}</h6>
                                </a>
                                <p class="text-muted mb-0">{{ __('Cheers!') }}</p>
                                <span class="status deactive text-mute"><i
                                        class="far fa-clock mr-10"></i>{{ __('10 min ago') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-6">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('Active Members') }}</h3>
                        <div class="card-header-right">
                            {{-- <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul> --}}
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Customer Name') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ __('HeadPhone') }}</td>
                                        <td><img src="../img/widget/p1.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$10') }}</td>
                                        <td>
                                            <a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Iphone 6') }}</td>
                                        <td><img src="../img/widget/p2.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$2') }}0</td>
                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a
                                                href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Jacket') }}</td>
                                        <td><img src="../img/widget/p3.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$35') }}</td>
                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a
                                                href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Sofa') }}</td>
                                        <td><img src="../img/widget/p4.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$85') }}</td>
                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a
                                                href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Iphone 6') }}</td>
                                        <td><img src="../img/widget/p2.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$20') }}</td>
                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a
                                                href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
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
