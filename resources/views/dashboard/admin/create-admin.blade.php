@include('dashboard.partials.main')

<head>

    @include('dashboard.partials.head-title-meta', ["title" => "Tambah Admin"])

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

                    @include('dashboard.partials.page-title', ["pagetitle" => "Admin", "title" => "Tambah Admin"])

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="nama-input">Nama</label>
                                        <input type="text" class="form-control" id="nama-input" placeholder="Masukkan Nama">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email-input">Email</label>
                                        <input type="text" class="form-control" id="email-input" placeholder="Masukkan Email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="nomor-telp-input">Nomor Telp</label>
                                        <input type="text" class="form-control" id="nomor-telp-input" placeholder="Masukkan Nomor Telp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="choices-jabatan-input" class="form-label">Jabatan</label>
                                        <select class="form-select" data-choices data-choices-search-false id="choices-jabatan-input">
                                            <option value="SPV" selected>SPV</option>
                                            <option value="Staff">Staff</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="choices-divisi-input" class="form-label">Divisi</label>
                                        <select class="form-select" data-choices data-choices-search-false id="choices-divisi-input">
                                            <option value="IT" selected>IT</option>
                                            <option value="Marketing">Marketing</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="text-end mb-4">
                            <button type="submit" class="btn btn-danger w-sm">Hapus</button>
                            <button type="submit" class="btn btn-success w-sm">Kirim Data</button>
                        </div>
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
    <!-- project-create init -->
    <script src="assets/js/pages/project-create.init.js"></script>

</body>

</html>
