@include('partials.header', ["title" => "Verify Login"])
  <!-- auth page content -->
  <div class="auth-page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-sm-5 mb-4 text-white-50">
                    <div>
                        <a href="" class="d-inline-block auth-logo">
                            <img src="/../assets/images/{{ env('APP_LOGO') }}.webp" alt="" height="100">
                        </a>
                    </div>
                    <p class="mt-3 fs-3 fw-bold text-white">Dashboard Admin SIKI</p>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4 card-bg-fill">

                    <div class="card-body p-4">
                        <div class="mb-4">
                            <div class="avatar-lg mx-auto">
                                <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                    <i class="ri-mail-line"></i>
                                </div>
                            </div>
                        </div>

                        <div class="p-2 mt-4">
                            <div class="text-muted text-center mb-4 mx-lg-3">
                                <h4>Verifikasi email kamu</h4>
                                <p>Silakan masukkan 8 digit kode yang dikirimkan ke <span class="fw-semibold">{{ Session::get('email') }}</span></p>
                            </div>
                            <div id="returned-error"></div>
                            <form id="verifyForm">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg bg-light border-light text-center"
                                           id="otp-input" maxlength="8" placeholder="Masukkan 8 digit OTP"  autocomplete="off"/>
                                </div>
                                <div id="otp-error" class="text-danger-emphasis"></div>
                                <div class="mt-3">
                                    <button id="submitButton" class="btn btn-primary w-100 fw-bold" type="submit">
                                        <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <span id="buttonText"><i class="mdi mdi-login"></i> Masuk</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="mt-4 text-center">
                    <form id="otpForm">
                        <p class="mb-0">
                            Tidak menerima kode ?
                            <button id="otpButton" type="submit" class="fw-semibold text-primary text-decoration-underline">
                                Kirim Ulang
                            </button>
                            <span id="countdown" class="text-muted ml-3" style="display:none;"> 1:00</span>
                        </p>
                    </form>
                </div>

            </div>
        </div>
        <!-- end row -->
<script type="text/javascript" src="/../assets/libs/jquery/jquery-2.2.4.min.js"></script>
<script>
    $('#otp-input').on('input', function() {
        const otp = $(this).val();

        if (otp.length === 8) {
            $('#verifyForm').submit();
        }
    });
    $('#verifyForm').on('submit', function (e) {
        e.preventDefault();

        const otp = $('#otp-input').val();
        const data = { otp: otp };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('verify.submit') }}",
            method: 'post',
            data: data,
            dataType: 'json',
            beforeSend: function() {
                $("[id$='-error']").empty();
                $('#submitButton').prop('disabled', true);
                $('#spinner').removeClass('d-none');
                $('#buttonText').text('Mengirim Data...');
            },
            success: function(data){
                if(data.error == true){
                    var hasOtherErrors = false;

                    $.each(data.message, function(field, error){
                        $('#'+field+'-error').html(error);
                    });
                }else{
                    $('#returned-error').html(data.message.returned);
                    //setTimeout(function(){
                        window.location.href="{{ route('dashboard') }}";
                        // }, 1000);
                }
            },
            complete: function() {
                $('#submitButton').prop('disabled', false);
                $('#spinner').addClass('d-none');
                $('#buttonText').html('<i class="mdi mdi-login"></i> Masuk');
            }
        });
    });
</script>

<script>
    $('#otpForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('resendOtp') }}",
            method: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#otpButton').prop('disabled', true);
                $('#countdown').show();

                let countdownTime = 60;
                const countdownInterval = setInterval(function() {
                    let minutes = Math.floor(countdownTime / 60);
                    let seconds = countdownTime % 60;
                    $('#countdown').text(`${minutes}:${seconds < 10 ? '0' : ''}${seconds}`);

                    countdownTime--;

                    if (countdownTime < 0) {
                        clearInterval(countdownInterval);
                        $('#otpButton').prop('disabled', false);
                        $('#countdown').hide();
                    }
                }, 1000);

                $("[id$='-error']").empty();
            },
            success: function(data) {
                if (data.error == true) {
                    $.each(data.message, function(field, error) {
                        $('#' + field + '-error').html(error);
                    });
                } else {
                    $('#returned-error').html(data.message.returned);
                }
            }
        });
    });
</script>


@include('partials.footer')
