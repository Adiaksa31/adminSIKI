<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <p class="mb-0 text-muted">Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script> - PT. SIKI Revolusi Inovasi.
                </p>
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    All right reserved.
                </div>
            </div>
        </div>

    </div>
</footer>
<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById('logout-button').addEventListener('click', function () {
        // Tampilkan SweetAlert untuk meminta konfirmasi logout
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Anda akan keluar dari sistem.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Keluar",
            cancelButtonText: "Batal",
            customClass: {
                confirmButton: "btn btn-primary w-xs me-2 mt-2",
                cancelButton: "btn btn-outline-danger w-xs mt-2",
            },
            buttonsStyling: false,
            showCloseButton: true,
        }).then(function (result) {
            // Jika pengguna menekan tombol "Keluar"
            if (result.isConfirmed) {
                // Lakukan proses logout setelah konfirmasi
                fetch('/logout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Sertakan token CSRF
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Jika logout berhasil, tampilkan pesan berhasil dan redirect ke login
                        if (!data.error) {
                            Swal.fire({
                                title: "Berhasil Keluar",
                                text: "Anda telah berhasil keluar dari sistem.",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1000,
                                willClose: () => {
                                    window.location.href = "{{ route('login') }}";
                                }
                            });
                        } else {
                            // Jika ada error, tampilkan pesan error
                            alert(data.message.returned);
                        }
                    })
                    .catch(error => {
                        // Jika terjadi kesalahan saat fetch
                        console.error('Logout error:', error);
                    });
            }
        });
    });
</script>
