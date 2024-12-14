@include('dashboard.partials.main')

<head>
    @include('dashboard.partials.head-title-meta', ["title" => "Permission"])
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
                    @include('dashboard.partials.page-title', ["pagetitle" => "Groups", "title" => "Permission"])
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Permission</h4>
                    </div>
                    @if (Session::get('role') === 'super_admin')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="minimal-border w-100">
                                <div id="returned-error"></div>
                                <x-card :title="'Permission'">
                                    <form id="add-permission" class="position-relative row g-2 mb-3">
                                        <!-- Input Permission -->
                                        <div class="col-12 d-flex flex-column flex-lg-row gap-3">
                                            <!-- Select -->
                                            <div class="d-flex flex-column flex-fill">
                                                <select name="permission_category_id" id="permission_category_id" class="form-select" aria-label="Pilih Permission">
                                                    <option value="" selected disabled>Pilih Permission</option>
                                                    @foreach ($dataPermission as $data)
                                                    <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div id="permission_category_id-error" class="text-danger-emphasis" style="min-height: 1em;"></div>
                                            </div>

                                            <!-- Input -->
                                            <div class="d-flex flex-column flex-fill">
                                                <input name="name" type="text" class="form-control" id="name" placeholder="Masukkan Permission">
                                                <div id="name-error" class="text-danger-emphasis" style="min-height: 1em;"></div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="d-flex flex-column">
                                                <button id="submitButton" class="btn btn-primary w-100" type="submit">
                                                    <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                    <span id="buttonText"><i class="mdi mdi-pencil-plus"></i> Tambah</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </x-card>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    @else
                    @endif
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#add-permission').on('submit', function(e) {
                e.preventDefault();
                var permissionValue = $('#permission_category_id').val();
                var nameValue = $('#name').val();
                // if (!permissionValue || !nameValue.trim()) {
                //     $('#name-error').text('Field tidak boleh kosong');
                //     return;
                // }
                var formData = {
                    permission_category_id: permissionValue,
                    name: nameValue
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('add.permission') }}",
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#name-error').empty();
                        $('#submitButton').prop('disabled', true);
                        $('#spinner').removeClass('d-none');
                        $('#buttonText').text('Tunggu...');
                    },
                    success: function(response) {
                        if (response.error) {
                            if (typeof response.message === 'object') {
                                $.each(response.message, function(field, error) {
                                    $('#' + field + '-error').html(error);
                                });
                            } else {
                                $('#returned-error').html(response.message);
                            }
                        } else {
                            $('#returned-error').html(response.message.returned);
                            setTimeout(function() {
                                window.location.href = "{{ route('permission') }}";
                            }, 1000);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $('#returned-error').html('Terjadi kesalahan pada server.');
                    },
                    complete: function() {
                        $('#submitButton').prop('disabled', false);
                        $('#spinner').addClass('d-none');
                        $('#buttonText').html('<i class="mdi mdi-pencil-plus"></i> Tambah');
                    }
                });
            });
        });
    </script>
</body>

</html>
