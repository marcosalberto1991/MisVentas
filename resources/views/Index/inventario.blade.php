@extends('layouts.App_admin_ui')


@section('content')
<section class="col-lg-12 connectedSortable">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-descripcion">Lista de Inventario</h3>
        </div>
        <div class="box-body">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading">


                    </div>

                    <div class="panel-body" style="overflow-x:auto;">
                        <table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">
                            <thead>


                                <tr>
                                    <th>id</th>
                                    <th>Código de producto</th>
                                    <th>Nombre</th>
                                    <th>Descricion</th>
                                    <th>cantidad de inventario comprado</th>
                                    <th>cantidad de inventario vendidos</th>
                                    <th>Stop</th>
                                </tr>

                            </thead>
                            <tbody>


                                @foreach($productos as $lists)

                                <tr id="item_{{$lists->id}}"
                                    class="item{{$lists->id}} @if($lists->is_published) warning @endif">
                                    <td class="col1">{{ $lists->id }}</td>
                                    <td class="col1">{{ $lists->codigo_producto }}</td>
                                    <td class="col1">{{ $lists->nombre }}</td>
                                    <td class="col1">{{ $lists->descricion }}</td>
                                    <?php $total=0  ?>
                                    @foreach ($lists->entrada_all as $value )
                                    <?php $total=$total+$value->cantidad; ?>
                                    @endforeach
                                    <td class="col1">{{ $total }}</td>

                                    <?php $total_vendidos=0  ?>
                                    @foreach ($lists->productos_has_venta_all as $value )
                                    @if($value->estado_venta_id==4)
                                    <?php $total_vendidos=$total_vendidos+$value->cantidad; ?>
                                    @endif

                                    @endforeach
                                    <td class="col1">{{ $total_vendidos }}</td>
                                    <td class="col1">{{ $total-$total_vendidos }}</td>






                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

<!-- Modal form to mass a form -->





@section("page-js-files")
<!--
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	-->
@stop
@section("page-js-script")


<script type='text/javascript'>
</script>

@stop
</body>

</html>