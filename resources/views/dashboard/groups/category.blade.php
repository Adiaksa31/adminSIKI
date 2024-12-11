@include('dashboard.partials.main')

<head>
    @include('dashboard.partials.head-title-meta', ["title" => "Category"])
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
                    @include('dashboard.partials.page-title', ["pagetitle" => "Groups", "title" => "Category"])

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Data Category</h4>
                    </div>

                    @if (Session::get('role') === 'super_admin')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="minimal-border w-100">
                                    @php
                                        $headersGroup = ['#', 'Nama Category', 'Description', 'Permissions', 'Aksi'];

                                        $rowsGroup = collect($categories ?? [])->map(function ($data, $index) {
                                            // Menyusun daftar permissions menjadi string
                                            $permissionsList = isset($data['permissions']) && is_array($data['permissions'])
                                                ? '<ul>' . collect($data['permissions'])->map(function ($permission) {
                                                    return '<li>' . ($permission['name'] ?? '-') . '</li>';
                                                })->implode('') . '</ul>'
                                                : '-';

                                            return [
                                                $index + 1,
                                                $data['name'] ?? '-',
                                                $data['description'] ?? '-',
                                                $permissionsList,
                                                '<div class="hstack gap-3 flex-wrap">
                                                    <a href="" class="link-success fs-15" title="Edit">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" data-id="' . $data['id'] . '" class="link-warning toggle-active fs-15" title="Toggle Active">
                                                        <i class="ri-toggle-fill"></i>
                                                    </a>
                                                </div>',
                                            ];
                                        })->toArray();
                                    @endphp
                                    <x-card :title="'Data category'">
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
                                        <x-table id="table-group" :headers="$headersGroup" :rows="$rowsGroup" />
                                    </x-card>
                                </div>
                            </div>
                        </div>
                    @else
                    @endif
                </div>
            </div>
            @include("dashboard.partials.footer")
        </div>
    </div>
    @include("dashboard.partials.scripts-js")
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
                url: "{{ route('toggle.active', ':id') }}".replace(':id', groupId),
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

            var url = categoryId ? "{{ route('update.category', ':id') }}".replace(':id', categoryId) : "{{ route('add.category') }}";

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
                            window.location.href = "{{ route('dashboard') }}";
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

</html>
