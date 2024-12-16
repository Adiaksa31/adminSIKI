@include('dashboard.partials.main')

<head>

    @include('dashboard.partials.head-title-meta', ["title" => "Edit Admin"])

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

                    @include('dashboard.partials.page-title', ["pagetitle" => "Admin", "title" => "Edit Admin"])

                    <div class="row">
                        <div class="col-lg-12">
                            <div id="returned-error"></div>
                            <x-card :title="'Formulir Update Staff'">
                                <form id="formEditAdmin" data-param-id="{{ $userData['id'] }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="fullname-input">Nama Lengkap</label>
                                                <input name="fullname" type="text" class="form-control" id="fullname-input" placeholder="Masukkan Nama Lengkap" value="{{ $userData['fullname'] }}">
                                                <div id="fullname-error" class="text-danger-emphasis"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="username-input">Nama Panggilan</label>
                                                <input name="username" type="text" class="form-control" id="username-input" placeholder="Masukkan Nama Panggilan" value="{{ $userData['username'] }}">
                                                <div id="username-error" class="text-danger-emphasis"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email-input">Email</label>
                                        <input name="email" type="text" class="form-control" id="email-input" placeholder="Masukkan Email" value="{{ $userData['email'] }}" disabled>
                                        <div id="email-error" class="text-danger-emphasis"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="phone-input">Nomor Telp</label>
                                        <input name="phone" type="number" class="form-control" id="phone-input" placeholder="Masukkan Nomor Telphone" value="{{ $userData['phone'] }}">
                                        <div id="phone-error" class="text-danger-emphasis"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="address-input">Alamat</label>
                                        <textarea name="address" class="form-control" id="address-input" rows="3" placeholder="Masukkan alamat">{{ $userData['address'] }}</textarea>
                                        <div id="address-error" class="text-danger-emphasis"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="group_id" value="{{ $userData['group']['id'] }}" class="d-none">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end my-3">
                                        <button id="submitButton" class="btn btn-primary fw-bold" type="submit">
                                            <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            <span id="buttonText"><i class="mdi mdi-send-outline"></i> Kirim Data</span>
                                        </button>
                                    </div>
                                </form>

                            </x-card>
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
    <script src="{{ asset('assets/js/pages/project-create.init.js') }}"></script>

    <script>
        $('#formEditAdmin').on('submit', function(e){
            e.preventDefault();
            let paramId = $(this).data('param-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('edit-admin.submit', ':paramId') }}".replace(':paramId', paramId),
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
                            window.location.href = "{{ route('admin') }}";
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
