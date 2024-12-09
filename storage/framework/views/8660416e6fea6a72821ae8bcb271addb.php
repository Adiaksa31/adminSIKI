<?php echo $__env->make('dashboard.partials.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<head>

    <?php echo $__env->make('dashboard.partials.head-title-meta', ["title" => "Divisi"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

                    <?php echo $__env->make('dashboard.partials.page-title', ["pagetitle" => "Groups", "title" => "Divisi"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Data Divisi</h4>
                    </div>



                    <?php if(Session::get('role') === 'super_admin'): ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="minimal-border w-100">
                                                    <?php
                                                        $headersGroup = ['#', 'Nama Divisi', 'Aksi'];
                                                        $rowsGroup = collect($dataGroup)->map(function ($data, $index) {
                                                            return [
                                                                $index + 1,
                                                                $data['name'] ?? '-',
                                                                '<div class="hstack gap-3 flex-wrap"><a href="' . $data['id'] . '" class="link-success fs-15" title="detail">
                                                                                                                                                                                                                                                                                    <i class="ri-pencil-line"></i>
                                                                                                                                                                                                                                                                             </a>
                                                                                                                                                                                                                                                                                                                                                          </div>',
                                                            ];
                                                        })->toArray();
                                                    ?>
                                                    <div id="returned-error"></div>
                                                    <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data Group']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Data Group')]); ?>
                                                        <form id="add-divisi" class="position-relative row g-2 mb-3">
                                                            <!-- Input Divisi -->
                                                            <div class="col-12 col-md-11">
                                                                <input name="name" type="text" class="form-control" id="name"
                                                                    placeholder="Masukkan Divisi">
                                                                <div id="name-error" class="text-danger-emphasis"></div>
                                                                <button type="button" class="btn-close position-absolute" aria-label="Close"
                                                                    id="closeButton"
                                                                    style="top: 8px; right: 10px; z-index: 1050; display: none;"></button>
                                                            </div>

                                                            <!-- Submit Button -->
                                                            <div class="col-12 col-md-1">
                                                                <button id="submitButton" class="btn btn-primary w-100 fw-bold"
                                                                    type="submit">
                                                                    <span id="spinner" class="spinner-border spinner-border-sm d-none"
                                                                        role="status" aria-hidden="true"></span>
                                                                    <span id="buttonText"><i class="mdi mdi-send-outline"></i> Kirim</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                        <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['id' => 'table-group','headers' => $headersGroup,'rows' => $rowsGroup]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table-group','headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($headersGroup),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rowsGroup)]); ?>
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
                    <?php else: ?>
                    <?php endif; ?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var nameInput = document.getElementById('name');
            var closeButton = document.getElementById('closeButton');
            var submitButton = document.getElementById('submitButton');
            var updateButton = document.getElementById('updateButton');

            if (nameInput.value.trim() !== '') {
                closeButton.style.display = 'block';
            }

            nameInput.addEventListener('input', function () {
                if (this.value.trim() !== '') {
                    closeButton.style.display = 'block';
                } else {
                    closeButton.style.display = 'none';
                }
            });

            closeButton.addEventListener('click', function () {
                nameInput.value = '';
                this.style.display = 'none';
            });

            $('.link-success').on('click', function (e) {
                e.preventDefault();
                var groupId = $(this).attr('href');

                $.ajax({
                    url: "<?php echo e(route('find.divisi')); ?>",
                    method: 'GET',
                    data: { id: groupId },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 200) {
                            $('#name').val(response.data.name);
                            submitButton.innerHTML = '<i class="mdi mdi-send-outline"></i> Update';
                            $('#add-divisi').data('group-id', response.data.id);
                            $('#closeButton').show();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching group data:", error);
                    }
                });
            });

            $('#add-divisi').on('submit', function (e) {
                e.preventDefault();

                var divisiId = $(this).data('group-id');
                var formData = $(this).serialize();
                if (divisiId) {
                    formData += '&id=' + divisiId;
                }

                var url = divisiId ? "<?php echo e(route('update.divisi')); ?>" : "<?php echo e(route('add.divisi')); ?>";
                var method = divisiId ? 'PATCH' : 'POST';

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: method,
                    data: formData,
                    dataType: 'json',
                    beforeSend: function () {
                        $("[id$='-error']").empty();
                        submitButton.disabled = true;
                        $('#spinner').removeClass('d-none');
                        $('#buttonText').text('Mengirim...');
                    },
                    success: function (data) {
                        if (data.error) {
                            if (typeof data.message === 'object') {
                                $.each(data.message, function (field, error) {
                                    $('#' + field + '-error').html(error);
                                });
                            } else {
                                $('#returned-error').html(data.message);
                            }
                        } else {
                            $('#returned-error').html(data.message.returned);
                            setTimeout(function () {
                                window.location.href = "<?php echo e(route('divisi')); ?>";
                            }, 1000);
                        }
                    },
                    complete: function () {
                        submitButton.disabled = false;
                        $('#spinner').addClass('d-none');
                        $('#buttonText').html('<i class="mdi mdi-send-outline"></i> Kirim');
                    }
                });
            });
        });
    </script>

</body>

</html><?php /**PATH C:\Users\BAYU\Downloads\adobe p\PT SIki\admin-2\adminSIKI\resources\views/dashboard/groups/divisi.blade.php ENDPATH**/ ?>