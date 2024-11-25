@include('partials.header', ["title" => "404 Not Found"])

   <!-- auth page content -->
   <div class="auth-page-content">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center pt-4">
                    <div class="">
                        <img src="/../assets/images/error.svg" alt="" class="error-basic-img move-animation">
                    </div>
                    <div class="mt-n4">
                        <h1 class="display-1 fw-medium">404</h1>
                        <h3 class="text-uppercase">Maaf, Halaman tidak Ditemukan 😭</h3>
                        <p class="text-muted mb-4">Halaman yang Anda cari tidak tersedia!</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->


@include('partials.footer')
