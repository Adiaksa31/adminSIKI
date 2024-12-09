<?php echo $__env->make('dashboard.partials.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<head>

    <?php echo $__env->make('dashboard.partials.head-title-meta', ["title" => "Tambah Admin"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

                    <?php echo $__env->make('dashboard.partials.page-title', ["pagetitle" => "Admin", "title" => "Tambah Admin"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div id="returned-error"></div>
                            <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Folmulir Tambah Staff']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Folmulir Tambah Staff')]); ?>
                                <form id="formAddAdmin">
                                    <div class="mb-3">
                                        <label class="form-label" for="fullname-input">Nama Lengkap</label>
                                        <input name="fullname" type="text" class="form-control" id="fullname-input" placeholder="Masukkan Nama Lengkap">
                                        <div id="fullname-error" class="text-danger-emphasis"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="username-input">Nama Panggilan</label>
                                        <input name="username" type="text" class="form-control" id="username-input" placeholder="Masukkan Nama Panggilan">
                                        <div id="username-error" class="text-danger-emphasis"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email-input">Email</label>
                                        <input name="email" type="text" class="form-control" id="email-input" placeholder="Masukkan Email">
                                        <div id="email-error" class="text-danger-emphasis"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="phone-input">Nomor Telp</label>
                                        <input name="phone" type="number" class="form-control" id="phone-input" placeholder="Masukkan Nomor Telphone">
                                        <div id="phone-error" class="text-danger-emphasis"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="address-input">Alamat</label>
                                        <textarea name="address" class="form-control" id="address-input" rows="3" placeholder="Masukkan alamat"></textarea>
                                        <div id="address-error" class="text-danger-emphasis"></div>
                                    </div>
                                    <input type="text" value="1" name="group_id" class="d-none">
                                    <div class="mb-3">
                                        <label for="choices-jabatan-input" class="form-label">Jabatan</label>
                                        <select class="form-select" data-choices data-choices-search-false id="choices-jabatan-input">
                                            <option value="" selected disabled>Pilih Jabatan</option>
                                            <option value="Staff">Staff</option>
                                            <option value="SPV">SPV</option>
                                            <option value="Manager">Manager</option>
                                        </select>
                                        <div id="jabatan-error" class="text-danger-emphasis"></div>
                                    </div>
                                    <div class="text-end my-3">
                                        <button id="submitButton" class="btn btn-primary fw-bold" type="submit"><span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span> <span id="buttonText"><i class="mdi mdi-send-outline"></i> Kirim Data</span></button>
                                    </div>
                                </form>
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
    <!-- project-create init -->
    <script src="<?php echo e(asset('assets/js/pages/project-create.init.js')); ?>"></script>

    <script>
        $('#formAddAdmin').on('submit', function(e){
            e.preventDefault();

            const jabatan = $('#choices-jabatan-input').val();

            const jabatanUrls = {
                "Manager": "<?php echo e(route('adminManager.submit')); ?>",
                "SPV": "<?php echo e(route('adminSpv.submit')); ?>",
                "Staff": "<?php echo e(route('adminStaff.submit')); ?>",
            };

            const ajaxUrl = jabatanUrls[jabatan];

            if (!ajaxUrl) {
                $('#jabatan-error').html('Silakan pilih jabatan yang valid.');
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: ajaxUrl,
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $("[id$='-error']").empty();
                    $('#submitButton').prop('disabled', true);
                    $('#spinner').removeClass('d-none');
                    $('#buttonText').text('Mengirim Data...');
                },
                success: function(data){
                    if(data.error == true){
                        $.each(data.message, function(field, error){
                            $('#' + field + '-error').html(error);
                        });
                    } else {
                        $('#returned-error').html(data.message.returned);
                        setTimeout(function(){
                            window.location.href = "<?php echo e(route('admin')); ?>";
                        }, 1000);
                    }
                },
                complete: function() {
                    $('#submitButton').prop('disabled', false);
                    $('#spinner').addClass('d-none');
                    $('#buttonText').html('<i class="mdi mdi-send-outline"></i> Kirim Data');
                }
            });
        });
    </script>

</body>

</html>
<?php /**PATH C:\Users\BAYU\Downloads\adobe p\PT SIki\admin-2\adminSIKI\resources\views/dashboard/admin/create-admin.blade.php ENDPATH**/ ?>