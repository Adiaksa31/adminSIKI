@include('dashboard.partials.main')

<head>

    @include('dashboard.partials.head-title-meta', ["title" => "Admin"])

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

            <div class="page-content">
                <div class="container-fluid">

                    @include('dashboard.partials.page-title', ["pagetitle" => "Admin", "title" => "Admin"])

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="minimal-border w-100">

                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Daftar Admin</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="text-end mb-3">
                                            <a href="{{ route('tambah-admin') }}" class="btn btn-primary fw-bold"><i class="ri-user-2-line"></i>  Tambah Admin</a>
                                        </div>
                                        <div class="px-4 mx-n4">
                                            <div class="table-responsive">
                                                <table id="table-anggota" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">

                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Nama Lengkap</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">Nomor Telp</th>
                                                                <th scope="col">Jabatan</th>
                                                                <th scope="col">Divisi</th>
                                                                {{-- <th scope="col">Aktif</th> --}}
                                                                <th scope="col">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $i = 1; @endphp
                                                            @if(count($dataStaff) > 0)
                                                                @foreach($dataStaff as $staff)
                                                                    <tr>
                                                                        <td>{{ $i++ }}</td>
                                                                        <td>{{ $staff['fullname'] }}</td>
                                                                        <td>{{ $staff['email'] }}</td>
                                                                        <td>{{ $staff['phone'] }}</td>
                                                                        <td>{{ $staff['role'] }}</td>
                                                                        <td>{{ $staff['division']['division'] }}</td>
                                                                        {{-- <td><span class="badge bg-success">Aktif</span></td> --}}
                                                                        <td>
                                                                            <div class="hstack gap-3 flex-wrap">
                                                                                <a href="javascript:void(0);" class="link-success fs-15" title="detail"><i class="ri-eye-close-line"></i></a>
                                                                                <a href="javascript:void(0);" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="7" class="text-center">Belum ada data</td>
                                                                </tr>
                                                            @endif

                                                        </tbody>

                                                </table>

                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
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

    <script type="text/javascript">
        function initializeTables() {
            new DataTable("#table-anggota");
        }
        document.addEventListener("DOMContentLoaded", function () {
            initializeTables();
        });
    </script>

</body>

</html>
