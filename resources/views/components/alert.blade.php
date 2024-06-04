@if(session()->has('type') && session()->has('message'))
<script>
    Swal.fire({
    title: "{{session('message')}}",
    icon: "{{session('type')}}"
});
</script>
@endif