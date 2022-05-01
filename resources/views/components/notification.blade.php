<script>
    toastr.options = {
        "progressBar" : true,
        "positionClass" : "toast-bottom-right"
    }
    @if(Session::has('status'))
        toastr.{{ Session::get('status') }}("{{ Session::get('messages') }}", "{{ Session::get('tittle') }}");
    @endif
</script>