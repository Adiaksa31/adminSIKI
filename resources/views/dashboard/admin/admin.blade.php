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
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Data Admin</h4>
                        <a href="{{ route('tambah-admin') }}" class="btn btn-primary fw-bold">
                            <i class="ri-user-2-line"></i> Tambah Admin
                        </a>
                    </div>

                    @php
                        function generateTableData($data, $id) {
                            $headers = ['#', 'Nama Lengkap', 'Email', 'Nomor Telp', 'Jabatan', 'Divisi', 'Aksi'];
                            $rows = collect($data)->map(function ($item, $index) {
                                return [
                                    $index + 1,
                                    $item['fullname'],
                                    $item['email'],
                                    $item['phone'],
                                    $item['role'],
                                    $item['group']['name'] ?? '-',
                                    '<div class="hstack gap-3 flex-wrap">
                                        <a href="javascript:void(0);" class="link-success fs-15" title="detail"><i class="ri-eye-close-line"></i></a>
                                        <a href="javascript:void(0);" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                    </div>',
                                ];
                            })->toArray();

                            return compact('headers', 'rows', 'id');
                        }

                        $tables = [
                            ['title' => 'Data Staff', 'data' => $dataStaff, 'id' => 'table-staff'],
                            ['title' => 'Data SPV', 'data' => $dataSpv, 'id' => 'table-spv'],
                            ['title' => 'Data Manager', 'data' => $dataManager, 'id' => 'table-manager'],
                        ];
                    @endphp

                    @foreach ($tables as $table)
                        @php
                            $tableData = generateTableData($table['data'], $table['id']);
                        @endphp
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="minimal-border w-100">
                                    <x-card :title="$table['title']">
                                        <x-table :id="$tableData['id']" :headers="$tableData['headers']" :rows="$tableData['rows']" />
                                    </x-card>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    @endforeach
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
