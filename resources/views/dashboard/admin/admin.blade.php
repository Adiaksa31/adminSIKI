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
                        <h4 class="mb-0">Data Admin
                            @if ($selectedGroup)
                            - {{ $selectedGroup }}
                            @endif
                        </h4>

                        <div class="d-flex align-items-center gap-3">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if ($selectedGroup)
                                        {{ $selectedGroup }}
                                    @else
                                    Semua Divisi
                                    @endif
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownFilter">
                                    <li><a class="dropdown-item" href="{{ route('admin') }}">Semua Divisi</a></li>
                                    @foreach ($dataGroups as $group)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin', ['divisi' => $group['name']]) }}">
                                                {{ $group['name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Button to add admin -->
                            <a href="{{ route('tambah-admin') }}" class="btn btn-primary fw-bold">
                                <i class="ri-user-2-line"></i> Tambah Admin
                            </a>
                        </div>
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
                                    isset($item['groups']['name']) ? $item['groups']['name'] : '-',
                                    '<div class="hstack gap-3 flex-wrap">
                                        <a href="' . route('edit-admin', ['paramId' => $item['username']]) . '" class="link-success fs-15" title="detail"><i class="ri-pencil-line"></i></a>
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
