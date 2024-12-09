@include('dashboard.partials.main')

<head>

    @include('dashboard.partials.head-title-meta', ["title" => "Divisi"])

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

                    @include('dashboard.partials.page-title', ["pagetitle" => "Groups", "title" => "Divisi"])
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Data Divisi</h4>
                    </div>
                    @if (Session::get('role') === 'super_admin')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="minimal-border w-100">
                                    @php
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
                                    @endphp
                                    <div id="returned-error"></div>
                                    <x-card :title="'Data Group'">
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
                                        <x-table id="table-group" :headers="$headersGroup" :rows="$rowsGroup" />
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
                    url: "{{route('find.divisi')}}",
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

                var url = divisiId ? "{{ route('update.divisi') }}" : "{{ route('add.divisi') }}";
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
                                window.location.href = "{{ route('divisi') }}";
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

</html>
