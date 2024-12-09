@include('dashboard.partials.main')

<head>

    @include('dashboard.partials.head-title-meta', ["title" => "Koperasi"])

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

                    @include('dashboard.partials.page-title', ["pagetitle" => "Koperasi", "title" => "Koperasi"])

                    {{-- jika data koperasi sudah da pakai ini --}}
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="minimal-border w-100">
                                @php
                                    $headersKoperasi = ['#', 'Nama Lengkap', 'Email', 'Nomor Telp', 'Jabatan', 'Divisi', 'Aksi'];
                                    $rowsKoperasi = collect($dataKoperasi)->map(function ($data, $index) {
                                        return [
                                            $index + 1,
                                            $data['fullname'],
                                            $data['email'],
                                            $data['phone'],
                                            $data['role'],
                                            $data['group']['name'] ?? '-',
                                            '<div class="hstack gap-3 flex-wrap">
                                                <a href="javascript:void(0);" class="link-success fs-15" title="detail"><i class="ri-eye-close-line"></i></a>
                                                <a href="javascript:void(0);" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                            </div>',
                                        ];
                                    })->toArray();
                                @endphp
                                <x-card :title="'Data Koperasi'">
                                    <x-table id="table-koperasi" :headers="$headersKoperasi" :rows="$rowsKoperasi" />
                                </x-card>
                            </div>
                        </div>
                        <!-- end col -->
                    </div> --}}
                    <!-- end row -->


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="minimal-border w-100">

                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Daftar Koperasi</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">

                                        <div class="px-4 mx-n4">
                                            <div class="table-responsive">
                                                <table id="table-anggota" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Nama Koperasi</th>
                                                            <th scope="col">NIB</th>
                                                            <th scope="col">AHU</th>
                                                            <th scope="col">Nomor Telp</th>
                                                            <th scope="col">Verifikasi</th>
                                                            <th scope="col">Aktif</th>
                                                            <th scope="col">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $i=1 @endphp
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>Koperasi Maju Jaya</td>
                                                            <td>Koperasi NIB</td>
                                                            <td>Koperasi AHU</td>
                                                            <td>+62 81234567890</td>
                                                            <td><span class="badge bg-success">Terverifikasi</span></td>
                                                            <td><span class="badge bg-success">Aktif</span></td>
                                                            <td>
                                                                <div class="hstack gap-3 flex-wrap">
                                                                    <a href="javascript:void(0);" class="link-success fs-15" title="detail"><i class="ri-eye-close-line"></i></a>
                                                                    <a href="javascript:void(0);" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
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

</body>

</html>
