<?php

namespace App\Console\Commands;

//use Illuminate\Console\Command;

use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;
use DB;




class NewController_3_2 extends Command
{
	/**
	* The name and signature of the console command.
	*
	* @var string
	*/
	//protected $signature = 'vista:new {user}';
	protected $signature = 'Marcos_4:new ';


	/**
	* The console command description.
	*
	* @var string
	*/
	protected $description = 'Crear un CRUD V 3.2  Bootstrap 4.1 - 2019';

	/**
	* Create a new command instance.
	*
	* @return void
	*/
	public function __construct()
	{
	   parent::__construct();
	}

	/**
	* Execute the console command.
	*
	* @return mixed
	*/
	public function handle()
	{
		
		$this->line(' ');
		$this->line('Creacion de un CRUD version 3.0 ');
		$this->line('ConsultaNamecontroller.php');
		$nombrecoNtrol = $this->ask('Nombre de Namecontroller ej: "Consulta" => ConsultaNamecontroller.php ');
		//$nombrecoNtrol="productos_ru";
		$namedatabase = $this->ask('Nombre de la tabla en la base de datos  ');
		//$namedatabase="productos";
		$NameController="Controller";
		$NameModel="Model";


		//$Usemodel='use App\.$NombreModel;';
		

		//$nameSpace = "app2";
		//$nameSpace = $this->ask('Ingrese el namespace donde irá el proyecto');
		//$nombretable=strtolower($nombrecoNtrol);
		$namecontrol=$nombrecoNtrol.$NameController;
		$controllerruta="".$nombrecoNtrol.$NameController;
		$NombreModel="".$nombrecoNtrol.$NameModel;
		//$nombrecoNtrol="controlodecreacion.php";
	   
	$p="'";

	$envss='<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class '.$NombreModel.' extends Model
	{
		protected $table = '.$p.$namedatabase.$p.';
		protected $fillable = [

	    	


		];
	}
	
	';	
	
	//file_put_contents(base_path().'/app2/'.$namecontrol.'.php', $imprimir);
	file_put_contents(base_path().'/app/'.$NombreModel.'.php', $envss);

	//file_put_contents(base_path().'/app2/'.$NombreModel.'.php', $envss);		

	//realizar la consulta en los campos de la base de datos
	$tables = DB::select("DESCRIBE $namedatabase");



	   $conun=0;
	   $consultaBD="";
	   foreach ($tables as  $value) {
		 // echo "@extends('layouts.app')";
		//$Tarea->descripcion = $request->descripcion;
			if ($conun==1) {
				$consultaBD=$consultaBD.' $'.$nombrecoNtrol.'->'.$value->Field.'=$request->'.$value->Field.';
				';
			}else{
				$conun=1;
			}

		
		  echo "data  $value->Field \n ";

		}
		echo "$consultaBD";
		$foranea="";
		$foraneaVi="";

		foreach ($tables as  $value) {
		   	if ($value->Key=="MUL") {
		   	
		   	$foranea=$foranea.'$'.$value->Field.' = '.$NombreModel.'::select("id","id as nombre")->get();
		   	';
		   	$foraneaVi=$foraneaVi.'"'.$value->Field.'" => $'.$value->Field.',';
		   	}		
	   	}
	   	$validar="";
	   	
	   	foreach ($tables as $value) {
	   		if (strpos($value->Type, 'int') !== false) {
	   			$validar=$validar."'$value->Field' => 'required|min:1|max:99999999',
	   			";
	   		}
	   		if (strpos($value->Type, 'varchar') !== false) {
	   			$validar=$validar."'$value->Field' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			";
	   		}
	   	}
$p="'";
$tr="App\\";
//$co="$tr.$NombreModel;";

$imprimir='<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use '.$tr.''.$NombreModel.';
use View;

use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class '.$namecontrol.' extends Controller
{
	public function __construct(){
		$this->middleware('.$p.'auth'.$p.');
	}
	   
	protected $rules =
	[
		
				'.$validar.'
	];

	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$'.$nombrecoNtrol.' = '.$NombreModel.'::all();

		'.$foranea.'
		return view('.$p.''.$nombrecoNtrol.'.index'.$p.', [ '.$foraneaVi.' '.$p.'listmysql'.$p.' => $'.$nombrecoNtrol.'] );

	}

	public function create(){}

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('.$p.'errors'.$p.' => $validator->getMessageBag()->toArray()));
		} else {
			$'.$nombrecoNtrol.' = new '.$NombreModel.'();
			
			'.$consultaBD.'
			$'.$nombrecoNtrol.'->save();
			return response()->json($'.$nombrecoNtrol.');
		}
	}

	public function show($id){}

	public function edit($id){}

	public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('.$p.'errors'.$p.' => $validator->getMessageBag()->toArray()));
		} else {
			$'.$nombrecoNtrol.' = '.$NombreModel.'::findOrFail($id);
			
			'.$consultaBD.'
		  
			$'.$nombrecoNtrol.'->save();
			return response()->json($'.$nombrecoNtrol.');
		}
	}

	public function destroy($id){
		$'.$nombrecoNtrol.' = '.$NombreModel.'::findOrFail($id);
		$'.$nombrecoNtrol.'->delete();
		return response()->json($'.$nombrecoNtrol.');
	}

}


';
	file_put_contents(base_path().'/app/Http/Controllers/'.$namecontrol.'.php', $imprimir);
	$this->line('Controlador creado con exitos');


$enws="";
$enws=$enws.	"<script type='text/javascript'>
			";
		foreach ($tables as  $value) {
			if ($value->Key=="MUL") {
			$enws=$enws.'<?php echo "const  Fora'.$value->Field.'= $'.$value->Field.';"; ?>
			';				
			}
		}

$enws=$enws.'</script>';




	$viewmarcos='@extends('.$p.'layouts.adminTE'.$p.')

'.$enws.'

@section('.$p.'content'.$p.')
<section class="col-lg-12 connectedSortable">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Lista de '.$nombrecoNtrol.'</h3>
		</div>          
		<div class="box-body">
	   		<div class="">
			<div class="panel panel-default">
				<div class="panel-heading">
					<ul>
						<li><i class="fa fa-file-text-o"></i> Acciones</li>
						@can('.$p.$nombrecoNtrol.' Add'.$p.')
							<button href="#" id="massadd-modal" class="btn btn-success  massmodal massadd">Añadir un '.$nombrecoNtrol.'</button>
						@endcan
					</ul>
				</div>

				<div class="panel-body" style="overflow-x:auto;">
					<table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">
					<thead>
';
$table="";
$table2="";
$table3="";



foreach ($tables as $value) {
		$table=$table."<th>".$value->Field."</th>
						";
		if($value->Key=="MUL"){

		//$table2=$table2.'<td class="col1">{{ $lists->'.$value->Field.' }}</td>';
		$table2=$table2.'<td class="col1">
						<script type="text/javascript">
							resulmunicipios_id=Fora'.$value->Field.'.find( cas => cas.id == {{ $lists->'.$value->Field.' }} );
							document.write(resulmunicipios_id.nombre); 
						</script>
						</td>
							';
		$table3=$table3.'data-'.$value->Field.'="{{ $lists->'.$value->Field.'}}"
						';
		
		}else{

		$table2=$table2.'<td class="col1">{{ $lists->'.$value->Field.' }}</td>
						';
		$table3=$table3.'data-'.$value->Field.'="{{ $lists->'.$value->Field.'}}"
						';

		}
		

}
		$table=$table."<th>Ultima Modificacion</th>";
		$table=$table."<th>Accion</th>";

$viewmarcos=$viewmarcos.'					   

					<tr>
						'.$table.'
								
					</tr>
					
					</thead>
					<tbody>


					@foreach($listmysql as $lists)
						  
					<tr id="item_{{$lists->id}}" class="item{{$lists->id}} @if($lists->is_published) warning @endif">
						'.$table2.'
						<td>
						<?php if(!$lists->updated_at<"0000-00-00"){ ?> 
							{{ \Carbon\Carbon::createFromFormat('.$p.'Y-m-d H:i:s'.$p.', $lists->updated_at)->diffForHumans() }}
						<?php } ?>
						</td>
						<td>
						@can('.$p.$nombrecoNtrol.' Show'.$p.')
						<button class="massshow-modal btn btn-success" 
						'.$table3.'
						
						>
						<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
						@endcan		
						@can('.$p.$nombrecoNtrol.' Editar'.$p.')
						<button class="edit-modal btn btn-info" 
						'.$table3.'
						
						><span class="glyphicon glyphicon-edit"></span> Editar</button>
						@endcan
						@can('.$p.$nombrecoNtrol.' Eliminar'.$p.') 
						
						<button class="massdelete-modal btn btn-danger"
						'.$table3.'
						
						><span class="glyphicon glyphicon-trash"></span>Eliminar</button>
				
						@endcan
										


						</td>
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
<div id="massModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-descripcion"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h3 class="text-center" id="msdelete">¿Seguro que quieres borrar los  datos?</h3>
				<form class="form-horizontal" id="formmass" role="form">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label " for="id">ID:</label>
							<input type="text" class="form-control" id="id_mass"  disabled>
						
					</div>
';
$pp='"';
$p="'";
$ps="$pp$p";

$form="";    
					foreach ($tables as  $value) {
					 // echo "@extends('layouts.app')";
					//$Tarea->descripcion = $request->descripcion;
						if ($value->Key=='PRI') {
						$form=$form."
							<!-- 
					<div class='form-group'>
						<label class='control-label' for='descripcion'>$value->Field:</label>
						<div class='col-sm-10'>
						-->
							<input type='hidden' name='".$value->Field."'  class='form-control'    id='".$value->Field."_mass' required='required' autofocus>
						<!--
							<p class='error$value->Field text-center alert alert-danger d-none'></p>
						</div>
					</div>
						-->
						";
						}else if($value->Key=='MUL'){
						
					$form=$form.'
					<div class="form-group">
						<label class="control-label" for="descripcion">'.$value->Field.':</label>
							
							<select name="'.$value->Field.'"  class="form-control" id="'.$value->Field.'_mass" required="required" autofocus >
									<option value=""></option>

								@foreach($'.$value->Field.' as $lists)
									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach
							
							</select>
							<!--
							<input type="select" class="form-control" id='.$value->Field.'_mass" required="required" autofocus>
							-->
							<p class="error'.$value->Field.' text-center alert alert-danger d-none"> llenar los datos</p>
					</div>
					';
							
						}else{

							if ($value->Type=="timestamp") {
								$readonly="readonly";
							}else{
								$readonly="";
							}
							
							//$cadena = "El 10 y el número 20 con menores que el 30"; 
							$limite = intval(preg_replace('/[^0-9]+/', '', $value->Type)); 
							//echo $resultado;
							if (strlen($limite)>1) {
								$left="maxlength='$limite'";
							}else{
								$left=" ";
							}

						$form=$form."
					<div class='form-group' id='".$value->Field."' >
						<label class='control-label' for='descripcion'>$value->Field:</label>
							<input type='text' name='".$value->Field."' class='form-control' id='".$value->Field."_mass' $left  $readonly required='required' autofocus>
							<p class='error$value->Field text-center alert alert-danger d-none'></p>
					</div>
					";

						}
					}
//echo "$form";


$enve='                        

					
					</form>
					<div class="modal-footer">

						<button type="button" id="acciones" class="btn btn-primary mass">
							<span class="glyphicon glyphicon-check"></span> massar
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class="glyphicon glyphicon-remove"></span> Cerrar
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>


<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Eliminar el registro</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      		</div>
      		<div class="modal-body">Se eliminar el registro de forma permanete 
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        		<button type="button" class="btn btn-danger delete"  data-dismiss="modal">Eliminar</button>
      		</div>
    	</div>
  	</div>
</div>	

	
@section("page-js-files")	
<!--
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	-->
@stop	
@section("page-js-script")
	
			
';
$enw="";
$enw=$enw.	"<script type='text/javascript'>
	";

		
$dine="$";
$enw=$enw.'</script>';


$obtener_datos="";
foreach ($tables as  $value) {
	$obtener_datos=$obtener_datos."$dine('#".$value->Field."_mass').val(data.data('$value->Field'));
	"; 
}

$envd="";
$enw=$enw."

<script type='text/javascript'>
function obtener_data(data) {
	$obtener_datos
}
//Añadir un registro
$(document).on('click', '.massadd', function() {
	$('.modal-descripcion').text('Añadir un nuevo registro');
	$('#msdelete').text(' ');
	$('#formmass')[0].reset();
	$('#massModal').modal('show');
	$('#acciones').attr('class', 'btn btn-success add');
	//$('#formmass').attr('id', 'form_add');
	$('#acciones').text('Añadir Nuevos ');
});
/*
$(document).on('click', '.masssssmodal', function() {
	$('.modal-descripcion').text('Añadir un nuevo registro');
	$('#msdelete').text(' ');

	$('#massmodal').modal('show');
	$('#acciones').attr('class', 'btn btn-success add');
	//$('#formmass').attr('id', 'form_add');
	$('#acciones').text('Añadir Nuevos ');
});
*/

// Vista de un registro
$(document).on('click', '.massshow-modal', function() {
	obtener_data($dine(this));					
	$('.modal-descripcion').text('Vista de los Datos');
	$('#msdelete').text(' ');
	$('#massModal').modal('show');
	$('#acciones').attr('class', 'btn btn-info hibe');
	$('#acciones').text('Visible');
	$('#acciones').attr('disabled');
});

// Editar un registro
$(document).on('click', '.edit-modal', function() {	
	obtener_data($dine(this));
	id = $dine('#id_mass').val();
	$('#acciones').attr('class', 'btn btn-warning edit');
	$('#acciones').text('Editar');
	$('.modal-descripcion').text('Editar un Dato');
	$('#massModal').modal('show');
	$('#msdelete').text(' ');
});

// Eliminar un registro
$(document).on('click', '.massdelete-modal', function() {
	$('#id_mass').val($(this).data('id'));
	id = $('#id_mass').val();           
	$('#DeleteModal').modal('show');
});



//enviar registro para eiminar
$('.modal-footer').on('click', '.delete', function() {
	$.ajax({
		type: 'DELETE',
		url: '$nombrecoNtrol/'+id,
		data: {
		'_token': $('input[name=_token]').val(),
		},
		success: function(data) {
			toastr.success('Dato Eliminado!', 'Operacion Exitosa', {timeOut: 5000});
			$('#item_' + data['id']).remove();
				
		}
	});
});
		

//enviar registro para añadir
$('.modal-footer').on('click', '.add', function() {
	$.ajax({
		type: 'POST',
		url: '$nombrecoNtrol',
		data: $('#formmass').serialize(),
		//data: {
";
				$formq="";
				foreach ($tables as  $value) {
				//$formq=$formq."'$value->Field': $('#".$value->Field."_mass').val(),
				//"; 
				}

				$forms="";
				foreach ($tables as  $value) {
				$forms=$forms."$('.error".$value->Field."').addClass('d-none');
				"; 
				}

				$formd="";
				foreach ($tables as  $value) {	
				$formd=$formd."if(data.errors.".$value->Field."){";
				$formd=$formd."$('.error".$value->Field."').removeClass('d-none');"; 
				$formd=$formd."$('.error".$value->Field."').text(data.errors.".$value->Field.");}";}
$envy="
		error: function(jqXHR, text, error){
        	toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {timeOut: 5000});
        },
		success: function(data) { 
			if ((data.errors)) {
				verificar(data);
				//$('#massModal').modal('show');
            	toastr.error('Formato Inválido!', 'En la verificación de datos <br>', {timeOut: 5000});	
			} else {
				toastr.success('Operación Exitosa!', 'Datos Guardados', {timeOut: 5000});
				operaciones(data,'add');
			}
		},
	});
});
						
//add
";


$envd=$envd."
//enviar registro para editar
$('.modal-footer').on('click', '.edit', function() {
	$.ajax({
		type: 'PUT',
		url: '$nombrecoNtrol/' + id,
		data: $('#formmass').serialize(), 
		error: function(jqXHR, text, error){
            toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});	
        },
		success: function(data) {
			if(data.errors){
				verificar(data);
            	toastr.error('Formato Inválido!', 'Formato invalido en el formulario <br>', {timeOut: 5000});	
				//$('#massModal').modal('show');
			} else {
               	toastr.success('Modificación Exitosa $nombrecoNtrol!', 'Datos Modificados', {timeOut: 5000});
                operaciones(data,'edit');
			";
$envd=$envd."";
$envd=$envd."
            }
        }
    });
});
</script>
";


foreach ($tables as  $value) {			
				if ($value->Key=='MUL') {
			//$envy=$envy.'const resul'.$value->Field.'=Fora'.$value->Field.'.find( cas => cas.id == data.'.$value->Field.' ); 
			//	';
				}
			}
	//	$envy=$envy."			$('#postTable').append(";

$boto="";

foreach ($tables as  $value) {
	if ($value->Key=="PRI") {			
		$boto=$boto.'"<tr  id='.$p.'item_"+data.'.$value->Field.'+"'.$p.'  class='.$p.'item"+data.'.$value->Field.'+"'.$p.'>"+
		';
		$boto=$boto.'"<td class='.$p.'col1'.$p.'>" + data.'.$value->Field.' + "</td>"+
		';
			//"<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td>"+						
	}else{
			
		if ($value->Key=='MUL') {
		$boto=$boto.'"<td>"+ resul'.$value->Field.'["nombre"]  +"</td>"+
		';	
		}else{
		$boto=$boto.'"<td>"+ data.'.$value->Field.'+"</td>"+
		';
		}
	}

}
	
$botones="";
	foreach ($tables as  $value) {
		$botones=$botones.'"data-'.$value->Field.'='.$p.'"+ data.'.$value->Field.'+"'.$p.'"+
		';
	}

?>

<?php
$pp='"';
$p="'";
$ps="$pp$p";



$envd=$envd.'

<script type="text/javascript">
function verificar(data) {

';
foreach ($tables as $value) {
	$envd=$envd."	$('.error".$value->Field."').addClass('d-none');
";	
	}

foreach ($tables as $value) {
$envd=$envd.'
	if (data.errors.'.$value->Field.') {
    	$(".error'.$value->Field.'").removeClass("d-none");
    	$(".error'.$value->Field.'").text(data.errors.'.$value->Field.');
    }
    ';
}


$envd=$envd.'

}
</script>


';
//$botones="";
	//foreach ($tables as  $value) {
	//	$botones=$botones.'"'.$p.'data-'.$value->Field.'='.$p.'"+ data.'.$value->Field.'+						';
	//}

$eff="";
foreach ($tables as  $value) {			
	if ($value->Key=='MUL') {
//$eff=$eff.'const resul'.$value->Field.'=Fora'.$value->Field.'.find( cas => cas.id == data.'.$value->Field.' ); 
//	';
	}
}
$envfo="";
foreach ($tables as  $value) {			
	if ($value->Key=='MUL') {
		$envfo=$envfo.'const resul'.$value->Field.'=Fora'.$value->Field.'.find( cas => cas.id == data.'.$value->Field.' ); 
		';
	}
}


$envd=$envd."
<script type='text/javascript'>
	function operaciones(data,operacion) {
	$envfo
	$eff

	var tabla=
		$boto
		$p<td>Ahorra</td><td>$p+					
	@can('$nombrecoNtrol Show') 
		$p <button class=".$pp."massshow-modal btn btn-success".$pp."  $p + 
		$botones 
		$pp$p><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  $pp+ 
	@endcan			
	
	@can('$nombrecoNtrol Editar')
		$pp <button class='edit-modal btn btn-info' $pp+
		$botones 
		$pp$p><span class='glyphicon glyphicon-edit'></span> Editar</button>  $pp+ 
	@endcan

	@can('$nombrecoNtrol Eliminar') 
		$pp<button class='massdelete-modal btn btn-danger'  $pp +
		$botones 
		$pp$p><span class='glyphicon glyphicon-trash'></span> Eliminar</button>  $pp+
	@endcan
	$pp </td></tr>$pp;

	if($p"."edit$p==operacion){		
		$($p"."#item_$p+data.id).replaceWith(tabla);
	}
	if($p"."add$p==operacion){
		$($p#myTable$p).append(tabla);
	}
} 
</script>
@stop
</body>
</html>

				
";
echo " ";
 //echo "$botones";
echo " ";


echo "





";


//$route=$nombrecoNtrol.

echo "Colocar el siguiente  codigo en Route web.php

";
echo "Route::get('$nombrecoNtrol/pdf', '".$nombrecoNtrol."Controller@pdf');
";
echo "Route::resource('$nombrecoNtrol','".$nombrecoNtrol."Controller');
";
//echo "Route::post('$nombrecoNtrol/changeStatus', array('as' => 'changeStatus', 'uses' => '".$nombrecoNtrol."Controller@changeStatus'));";

echo "<br><br>";


   	
   	$directorio = public_path().'/app2/'.$nombrecoNtrol;
   	$directorio = base_path().'/resources/views/'.$nombrecoNtrol;
	//if (!File::exists($directorio )) {
   	//$resultado = File::makeDirectory($directorio , 0777, true,true);
   	//$directorio = '/ruta/a/mi/carpeta';
	if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);

}


	file_put_contents(base_path().'/resources/views/'.$nombrecoNtrol.'/index.blade.php', $viewmarcos.$form.$enve.$enw.$envy.$envd);
	//file_put_contents(base_path().'/app2/index.blade.php', $viewmarcos.$form.$enve.$enw.$envt.$envyq.$envy.$envu.$envd);
	$this->line('Controlador creado con exitos');
		  
	}
}