<?php echo $__env->make('dashboard.partials.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<head>

    <?php echo $__env->make('dashboard.partials.head-title-meta', ["title" => "Admin"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

                    <?php echo $__env->make('dashboard.partials.page-title', ["pagetitle" => "Admin", "title" => "Admin"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Data Admin</h4>
                        <a href="<?php echo e(route('tambah-admin')); ?>" class="btn btn-primary fw-bold">
                            <i class="ri-user-2-line"></i> Tambah Admin
                        </a>
                    </div>

                    <?php
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
                    ?>

                    <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $tableData = generateTableData($table['data'], $table['id']);
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="minimal-border w-100">
                                    <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => $table['title']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($table['title'])]); ?>
                                        <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['id' => $tableData['id'],'headers' => $tableData['headers'],'rows' => $tableData['rows']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableData['id']),'headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableData['headers']),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableData['rows'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\Users\BAYU\Downloads\adobe p\PT SIki\admin-2\adminSIKI\resources\views/dashboard/admin/admin.blade.php ENDPATH**/ ?>