<?php echo $__env->make('dashboard.partials.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<head>

    <?php echo $__env->make('dashboard.partials.head-title-meta', ["title" => "User"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     <!-- link css -->

    <?php echo $__env->make('dashboard.partials.head-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php echo $__env->make('dashboard.partials.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('dashboard.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content overflow-hidden">

            <div class="page-content">
                <div class="container-fluid">

                    <?php echo $__env->make('dashboard.partials.page-title', ["pagetitle" => "User", "title" => "User"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    
                    
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="minimal-border w-100">

                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Daftar User</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">

                                        <div class="px-4 mx-n4">
                                            <div class="table-responsive">
                                                <table id="table-anggota" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Nama Lengkap</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Nomor Telp</th>
                                                            <th scope="col">Verfikasi</th>
                                                            <th scope="col">Aktif</th>
                                                            <th scope="col">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1 ?>
                                                        <tr>
                                                            <td><?php echo e($i++); ?></td>
                                                            <td>John Doe</td>
                                                            <td>dummy@example.com</td>
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

            <?php echo $__env->make("dashboard.partials.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php echo $__env->make("dashboard.partials.scripts-js", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- link js -->

</body>

</html>
<?php /**PATH C:\Users\BAYU\Downloads\adobe p\PT SIki\admin-2\adminSIKI\resources\views/dashboard/user/user.blade.php ENDPATH**/ ?>