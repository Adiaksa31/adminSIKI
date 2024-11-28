@include('dashboard.partials.main')

<head>

    @include('dashboard.partials.head-title-meta', ["title" => "Tambah Admin"])

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

                    @include('dashboard.partials.page-title', ["pagetitle" => "Admin", "title" => "Tambah Admin"])

                    <div class="row">
                        <div class="col-lg-12">
                            <div id="returned-error"></div>
                            <div class="card">
                                <form id="formAddAdmin">
                                    <div class="card-header align-items-center">
                                        <h4 class="card-title mb-0 flex-grow-1">Folmulir Tambah Staff</h4>
                                    </div>
                                    <div class="card-body">
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
                                        <input type="text" value="1" name="division_id" class="d-none">
                                        {{-- <div class="mb-3">
                                            <label for="choices-jabatan-input" class="form-label">Jabatan</label>
                                            <select class="form-select" data-choices data-choices-search-false id="choices-jabatan-input">
                                                <option value="SPV" selected>SPV</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="choices-divisi-input" class="form-label">Divisi</label>
                                            <select class="form-select" data-choices data-choices-search-false id="choices-divisi-input">
                                                <option value="IT" selected>IT</option>
                                                <option value="Marketing">Marketing</option>
                                            </select>
                                        </div> --}}
                                        <div class="text-end my-3">
                                            {{-- <button type="submit" class="btn btn-danger w-sm">Hapus</button> --}}
                                            <button id="submitButton" class="btn btn-primary fw-bold" type="submit"><span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span> <span id="buttonText"><i class="mdi mdi-send-outline"></i> Kirim Data</span></button>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </form>

                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

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
    <!-- project-create init -->
    <script src="assets/js/pages/project-create.init.js"></script>
    <script>
           $('#formAddAdmin').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.submit') }}",
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
                                $('#'+field+'-error').html(error);
                            });
                        }else{
                            $('#returned-error').html(data.message.returned);
                            setTimeout(function(){
                                window.location.href = "{{ route('admin') }}";
                                }, 2000);
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
