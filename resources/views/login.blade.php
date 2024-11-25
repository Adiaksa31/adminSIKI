@include('partials.header', ["title" => "Login"])

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
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Masuk Admin SIKI !</h5>
                        </div>
                        <div class="p-2 mt-4">
                            <div id="returned-error"></div>
                            <form id="loginForm">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama Pengguna/Email/Telepon</label>
                                    <input name="username" type="text" class="form-control" id="username" placeholder="Masukkan Nama Pengguna/Email/Telepon">
                                    <div id="username-error" class="text-danger-emphasis"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Kata Sandi</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" name="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Masukkan kata sandi" id="password-input" aria-describedby="passwordInput">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" onclick="togglePasswordVisibility('password-input', this)">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                            <div id="password-error" class="text-danger-emphasis"></div>
                                        </div>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" name="rememberme" id="rememberme" type="checkbox" value="" id="auth-remember-check">
                                    <label class="form-check-label" for="auth-remember-check">Ingat saya</label>
                                </div>

                                <div class="my-3">
                                    <div class="d-flex justify-content-center">
                                         <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                                    </div>
                                    <div class="px-5">
                                        <div id="captcha-error" class="text-danger-emphasis"></div>
                                    </div>
                                </div>

                                <div class="my-3">
                                    <button id="submitButton" class="btn btn-primary w-100 fw-bold" type="submit"><span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span> <span id="buttonText"><i class="mdi mdi-login"></i> Masuk</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
        </div>
        <!-- end row -->

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript" src="/../assets/libs/jquery/jquery-2.2.4.min.js"></script>
<script>
    function togglePasswordVisibility(inputId, button) {
        const input = document.getElementById(inputId);
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';

        const icon = button.querySelector('i');
        icon.classList.toggle('ri-eye-fill', !isPassword);
        icon.classList.toggle('ri-eye-off-fill', isPassword);
    }
    $('#loginForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('login.submit') }}",
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
                    var hasOtherErrors = false; // Untuk cek apakah ada error lain
                    // Validasi error input lainnya
                    $.each(data.message, function(field, error){
                        $('#'+field+'-error').html(error);
                        hasOtherErrors = true; // Tanda bahwa ada error di input lain
                    });

                    // Pengecekan captcha setelah validasi input lainnya
                    if (grecaptcha.getResponse() == "") {
                        $('#captcha-error').html('Lengkapi Captcha agar Anda dapat melanjutkan.');
                    }
                    if (hasOtherErrors) {
                        // Reset captcha jika ada error di input lain
                        grecaptcha.reset();
                    }

                }else{
                    $('#returned-error').html(data.message.returned);
                    var redirectUrl = data.redirect_url;
                    //setTimeout(function(){
                        window.location.href = redirectUrl;
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
@include('partials.footer')
