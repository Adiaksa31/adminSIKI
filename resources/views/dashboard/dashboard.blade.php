@include('dashboard.partials.main')

<head>

    @include('dashboard.partials.head-title-meta', ["title" => "Dashboard"])

    <!-- link css -->

    @include('dashboard.partials.head-css')

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('dashboard.partials.topbar')
        @include('dashboard.partials.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content overflow-hidden">

            <div class="page-content mb-3">
                <div class="container-fluid">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Selamat <span id="greeting"></span>, {{ ucwords(Session::get('username')) }}!</h4>
                                    <p class="text-muted mb-0">Semoga hari-harimu selalu menyenangkan.</p>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                    <form action="javascript:void(0);">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-sm-auto">
                                                <div class="input-group">
                                                    <input type="text" class="form-control border-0 minimal-border dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                    <div class="input-group-text bg-primary border-primary text-white">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                    <div class="row row-cols-xl-3 row-cols-md-1 row-cols-1 g-2 mb-3">
                        <div class="col">
                            <h5 class="text-muted text-uppercase fs-13">Admin</h5>
                            <div class="row row row-cols-xxl-2 row-cols-md-2 row-cols-1 g-2">
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-book-account align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Total Admin</p>
                                                    <h4 class="mb-0"><span class="counter-value" data-target="10">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-book-check align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Aktif</p>
                                                    <h4 class="mb-0"><span class="counter-value" data-target="10">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-book-clock align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Non-Aktif</p>
                                                    <h4 class="mb-0"><span class="counter-value" data-target="0">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-book-cancel align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Banned</p>
                                                    <h4 class="mb-0"><span class="counter-value" data-target="0">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col">
                            <h5 class="text-muted text-uppercase fs-13">User</h5>
                            <div class="row row row-cols-xxl-2 row-cols-md-2 row-cols-1 g-2">
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-account-multiple align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Total User</p>
                                                    <h4 class=" mb-0"><span class="counter-value" data-target="10">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-account-check align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Verifikasi</p>
                                                    <h4 class=" mb-0"><span class="counter-value" data-target="10">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-account-clock align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Non-Verifikasi</p>
                                                    <h4 class=" mb-0"><span class="counter-value" data-target="0">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-account-cancel align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Banned</p>
                                                    <h4 class=" mb-0"><span class="counter-value" data-target="0">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col">
                            <h5 class="text-muted text-uppercase fs-13">Koperasi</h5>
                            <div class="row row row-cols-xxl-2 row-cols-md-2 row-cols-1 g-2">
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-home-group align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Total Koperasi</p>
                                                    <h4 class=" mb-0"><span class="counter-value" data-target="10">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-home align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Verifikasi</p>
                                                    <h4 class=" mb-0"><span class="counter-value" data-target="10">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-home-alert align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Non-Verifikasi</p>
                                                    <h4 class=" mb-0"><span class="counter-value" data-target="0">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col">
                                    <div class="card m-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                        <i class="mdi mdi-home-remove align-middle"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Banned</p>
                                                    <h4 class=" mb-0"><span class="counter-value" data-target="0">0</span></h4>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="row g-0 mb-3">
                                        <div class="col-xxl-12">
                                            <div class="">
                                                <div class="card-header border-0 align-items-center d-flex">
                                                    <h4 class="card-title mb-0 flex-grow-1">Statistik</h4>
                                                    <div>
                                                        <button type="button" class="btn btn-soft-secondary btn-sm material-shadow-none">
                                                            ALL
                                                        </button>
                                                        <button type="button" class="btn btn-soft-secondary btn-sm material-shadow-none">
                                                            1M
                                                        </button>
                                                        <button type="button" class="btn btn-soft-secondary btn-sm material-shadow-none">
                                                            6M
                                                        </button>
                                                        <button type="button" class="btn btn-soft-primary btn-sm material-shadow-none">
                                                            1Y
                                                        </button>
                                                    </div>
                                                </div><!-- end card header -->
                                                <div class="row g-0 text-center">
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="1">0</span></h5>
                                                            <p class="text-muted mb-0">Admin</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="3">0</span></h5>
                                                            <p class="text-muted mb-0">User</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-end-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="4">0</span></h5>
                                                            <p class="text-muted mb-0">Koperasi</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <div id="line_chart_basic" data-colors='["--vz-primary","--vz-success", "--vz-light"]' data-colors-corporate='["--vz-primary","--vz-secondary", "--vz-light"]' data-colors-galaxy='["--vz-primary","--vz-success", "--vz-secondary"]' data-colors-classic='["--vz-primary","--vz-light", "--vz-secondary"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div><!--end row-->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include("dashboard.partials.footer")
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    @include("dashboard.partials.scripts-js")


    <!-- link js -->
     <!-- apexcharts -->
     <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
     <!--Swiper slider js-->
     <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
     <!-- Marketplace init -->
     <script src="{{ asset('assets/js/pages/dashboard-nft.init.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const greetingElement = document.getElementById('greeting');
            const currentHour = new Date().getHours();
            let greeting;
            if (currentHour >= 5 && currentHour < 12) {
                greeting = "Pagi";
            } else if (currentHour >= 12 && currentHour < 18) {
                greeting = "Siang";
            } else {
                greeting = "Malam";
            }
            greetingElement.textContent = greeting;
        });
    </script>

</body>

</html>
