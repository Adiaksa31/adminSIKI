<?php echo $__env->make('dashboard.partials.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<head>
    <?php echo $__env->make('dashboard.partials.head-title-meta', ["title" => "Category"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                    <?php echo $__env->make('dashboard.partials.page-title', ["pagetitle" => "Groups", "title" => "Category"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Data Category</h4>
                    </div>

                    <?php if(Session::get('role') === 'super_admin'): ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="minimal-border w-100">
                                                    <?php
                                                        $headersGroup = ['#', 'Nama Category', 'Description', 'Aksi'];
                                                        $rowsGroup = collect($categories ?? [])->map(function ($data, $index) {
                                                            return [
                                                                $index + 1,
                                                                $data['name'] ?? '-',
                                                                $data['description'] ?? '-',
                                                                '<div class="hstack gap-3 flex-wrap">
                                                                <a href="' . $data['id'] . '" class="link-success fs-15" title="Edit"><i class="ri-pencil-line"></i></a>
                                                            <a href="javascript:void(0);" data-id="' . $data['id'] . '" class="link-warning toggle-active fs-15" title="Toggle Active">
                                                             <i class="ri-toggle-fill"></i>
                                                             </a>
                                                            </div>',
                                                            ];
                                                        })->toArray();
                                                    ?>
                                                    <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data category']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Data category')]); ?>
                                                        <form id="add-category" class="position-relative row g-2 mb-3">
                                                            <div class="col-12 col-md-11">
                                                                <input name="name" type="text" class="form-control" id="name"
                                                                    placeholder="Masukkan Category">
                                                                <div id="name-error" class="text-danger-emphasis"></div>
                                                                <button type="button" class="btn-close position-absolute" aria-label="Close"
                                                                    id="closeButton"
                                                                    style="top: 8px; right: 10px; z-index: 1050; display: none;"></button>
                                                            </div>
                                                            <div class="col-12 col-md-1 d-grid">
                                                                <button id="submitButton" class="btn btn-primary w-100 fw-bold"
                                                                    type="submit">
                                                                    <span id="spinner" class="spinner-border spinner-border-sm d-none"
                                                                        role="status" aria-hidden="true"></span>
                                                                    <span id="buttonText"><i class="mdi mdi-send-outline"></i> Kirim</span>
                                                                </button>
                                                                <button id="updateButton" class="btn btn-primary w-100 fw-bold"
                                                                    type="button" style="display: none;">
                                                                    <span id="spinner" class="spinner-border spinner-border-sm d-none"
                                                                        role="status" aria-hidden="true"></span>
                                                                    <span id="buttonText"><i class="mdi mdi-update"></i> Update</span>
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
                                        </div>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $__env->make("dashboard.partials.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <?php echo $__env->make("dashboard.partials.scripts-js", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- link js -->
    <script>
        document.getElementById('name').addEventListener('input', function () {
            var closeButton = document.getElementById('closeButton');
            closeButton.style.display = this.value.trim() !== '' ? 'block' : 'none';
        });

        document.getElementById('closeButton').addEventListener('click', function () {
            document.getElementById('name').value = '';
            this.style.display = 'none';
        });

        // Handle toggle active
        $('.toggle-active').on('click', function () {
            var groupId = $(this).data('id');

            $.ajax({
                url: "<?php echo e(route('toggle.active', ':id')); ?>".replace(':id', groupId),
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status === 200) {
                        alert('Status berhasil diperbarui!');
                        location.reload();
                    } else {
                        console.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error updating status:", error);
                }
            });
        });



        $('#add-category').on('submit', function (e) {
            e.preventDefault();

            var categoryId = $(this).data('group-id');

            var url = categoryId ? "<?php echo e(route('update.category', ':id')); ?>".replace(':id', categoryId) : "<?php echo e(route('add.category')); ?>";

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: categoryId ? 'PUT' : 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $("[id$='-error']").empty();
                    $('#submitButton').prop('disabled', true);
                    $('#spinner').removeClass('d-none');
                    $('#buttonText').text('Mengirim Data...');
                },
                success: function (data) {
                    if (data.error) {
                        $.each(data.message, function (field, error) {
                            $('#' + field + '-error').html(error);
                        });
                    } else {
                        $('#returned-error').html(data.message.returned);
                        setTimeout(function () {
                            window.location.href = "<?php echo e(route('dashboard')); ?>";
                        }, 1000);
                    }
                },
                complete: function () {
                    $('#submitButton').prop('disabled', false);
                    $('#spinner').addClass('d-none');
                    $('#buttonText').html('<i class="mdi mdi-send-outline"></i> Kirim Data');
                }
            });
        });

    </script>
</body>

</html><?php /**PATH C:\Users\BAYU\Downloads\adobe p\PT SIki\admin-2\adminSIKI\resources\views/dashboard/groups/category.blade.php ENDPATH**/ ?>