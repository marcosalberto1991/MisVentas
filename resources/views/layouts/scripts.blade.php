@section('scripts')  
<script>

    $('.input-number-line').on('input', function () { 
      this.value = this.value.replace(/[^0-9-]/g,'');
    });
    $('.input-number').on('input', function () { 
      this.value = this.value.replace(/[^0-9]/g,'');
    });
    $('.input-number-coma').on('input', function () { 
      this.value = this.value.replace(/[^0-9,]/g,'');
    });
    $('.input-number-coma-punto').on('input', function () { 
      this.value = this.value.replace(/[^0-9,]/g,'');
    });

</script>


<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>



@stop
