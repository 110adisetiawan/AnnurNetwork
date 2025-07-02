@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            toast: true
            , position: 'top-end'
            , icon: 'error'
            , title: '{{ session('error') }}'
            , showConfirmButton: false
            , timer: 5000
            , timerProgressBar: true
            , customClass: {
                popup: 'toast-error'
            }
        });
    });

</script>
@endif

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errors = @json($errors -> all());

        // Bangun daftar <ul> dari semua pesan error
        let htmlList = '<ul style="margin:0; padding-left:1.5em; text-align:left;">';
        errors.forEach(msg => {
            htmlList += `<li>${msg}</li>`;
        });
        htmlList += '</ul>';

        Swal.fire({
            toast: true
            , position: 'top-end'
            , icon: 'error'
            , title: 'Validasi Gagal'
            , html: htmlList
            , showConfirmButton: false
            , timer: 6000
            , timerProgressBar: true
            , customClass: {
                popup: 'toast-ul-error toast-pink'
            }
        });
    });

</script>
@endif
