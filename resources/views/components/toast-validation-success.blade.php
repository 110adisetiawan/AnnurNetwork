@if(session('success'))
<script>
    Swal.fire({
        toast: true
        , position: 'top-end'
        , icon: 'success'
        , title: '{{ session('success') }}'
        , showConfirmButton: false
        , timer: 3000
        , timerProgressBar: true
    });

</script>
@endif
