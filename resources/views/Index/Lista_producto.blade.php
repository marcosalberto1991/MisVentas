@extends('layouts.app_admin_ui')
@section('content')
<style>
    .card {
        background-color: #b9b9b9;
    }
</style>
<section class="">

    <div class="row">
        @foreach($productos as $lists)
        <div class="col-md-2 col-sm-12" style="margin-bottom: 25px;">
            <div class="card" style="">
                <img src="{{ asset('perfil_usuario/'.$lists->imagen) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">$ {{ $lists->precio_venta }}</h5>
                    <h5 class="card-title">{{ $lists->nombre }}</h5>
                    <p class="card-text">{{ $lists->descricion }}</p>
                    <form action="{{ action('IndexController@store') }}" id="carrito_sutmib" method="POST">
                        {{ csrf_field() }}
                        <a href="#" class="btn btn-primary" onclick="cantidad({{ $lists->id }},0)">-</a>
                        <input type="hidden" name="productos_id" value="{{ $lists->id }}">
                        <input class="input-number" name="cantidad" id="{{ $lists->id }}" type="number"
                            style="text-align: center; width: 30px;" min="1" value="1">
                        <a href="#" class="btn btn-primary" onclick="cantidad({{ $lists->id }},1)">+</a>
                        <button type="submit" class="btn btn-primary"><img src="images/carrito2.png"> Añadir al
                            carrito</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div><!-- /.panel panel-default -->
</section>
@endsection

<!--
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar el registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">Se eliminar el registro de forma permanete
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-danger delete" data-dismiss="modal">Eliminar</button>
			</div>
		</div>
	</div>
</div>
-->

@section("page-js-files")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@stop
@section("page-js-script")
<script>
    //$("#carrito_sutmib").on('submit', function(evt){
    $("#carrito_sutmib").submit(function(e){
    e.preventDefault();
    var form = $(this);
    console.info(form.serialize() );
 });




    function cantidad( id_input, operacion){
    var numero=$('#'+id_input).val();
    if(operacion=='1'){
      numero++;
    } else{
      numero--;
      if(numero<=0){
        numero=1;
      }
    }
    $('#'+id_input).val(numero);
  }
</script>
@stop
</body>

</html>