<?php

namespace App\Console\Commands;

//use Illuminate\Console\Command;

use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;
use DB;




class NewController extends Command
{
	/**
	* The name and signature of the console command.
	*
	* @var string
	*/
	//protected $signature = 'vista:new {user}';
	protected $signature = 'NewContro:new ';


	/**
	* The console command description.
	*
	* @var string
	*/
	protected $description = 'Crear un controlador';

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
		$this->line('crear Archivo  Consulta ');
		$this->line('ConsultaNamecontroller.php');
		$nombrecoNtrol = $this->ask('Nombre de Namecontroller ej: "Consulta" => ConsultaNamecontroller.php ');
		//$nombrecoNtrol="Solicitude";
		$namedatabase = $this->ask('Nombre de la tabla en la base de datos  ');
		//$namedatabase="solicitudes";
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

	file_put_contents(base_path().'/app2/'.$NombreModel.'.php', $envss);		

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
	   			$validar=$validar."'$value->Field' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
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
use App\Solicitude_tipo;

use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class '.$namecontrol.' extends Controller
{
	public function __construct()
	{
		$this->middleware('.$p.'auth'.$p.');
	   


	}
	/**
	* @var array
	*/
	protected $rules =
	[
		
				'.$validar.'
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$'.$nombrecoNtrol.' = '.$NombreModel.'::all();

		'.$foranea.'
		return view('.$p.''.$nombrecoNtrol.'.index'.$p.', [ '.$foraneaVi.' '.$p.'listmysql'.$p.' => $'.$nombrecoNtrol.'] );

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(){
		
	}
	 /**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
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
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$'.$nombrecoNtrol.' = '.$NombreModel.'::findOrFail($id);

		return view('.$p.''.$nombrecoNtrol.'.show'.$p.', ['.$p.''.$NombreModel.''.$p.' => $'.$nombrecoNtrol.']);
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
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


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$'.$nombrecoNtrol.' = '.$NombreModel.'::findOrFail($id);
		$'.$nombrecoNtrol.'->delete();
		return response()->json($'.$nombrecoNtrol.');
	}


	/**
	* Change resource status. '.$NombreModel.'
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('.$p.'id'.$p.');

		$'.$nombrecoNtrol.' = '.$NombreModel.'::findOrFail($id);
		$'.$nombrecoNtrol.'->is_published = !$'.$NombreModel.'->is_published;
		$'.$nombrecoNtrol.'->save();

		return response()->json($'.$nombrecoNtrol.');
	}
}


';
	file_put_contents(base_path().'/app/Http/Controllers/'.$namecontrol.'.php', $imprimir);
	$this->line('Controlador creado con exitos');






	$viewmarcos='@extends('.$p.'layouts.app'.$p.')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('.$p.'images/favicon.jpg'.$p.') }}">
<!-- CSFR token for ajax call -->
<meta name="_token" content="{{ csrf_token() }}"/>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
{{-- <link rel="styleeheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<!-- icheck checkboxes -->
<!--<link rel="stylesheet" href="{{ asset('.$p.'icheck/square/yellow.css'.$p.') }}">-->
{{-- <link rel="stylesheet" href="https://raw.githubusercontent.com/fronteed/icheck/1.x/skins/square/yellow.css"> --}}
<!-- toastr notifications -->
{{-- <link rel="stylesheet" href="{{ asset('.$p.'toastr/toastr.min.css'.$p.') }}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- Font Awesome -->
{{-- <link rel="stylesheet" href="{{ asset('.$p.'font-awesome/css/font-awesome.min.css'.$p.') }}"> --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

	<style>
		.panel-heading {
			padding: 0;
		}
		.panel-heading ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
		}
		.panel-heading li {
			float: left;
			border-right:1px solid #bbb;
			display: block;
			padding: 14px 16px;
			text-align: center;
		}
		.panel-heading li:last-child:hover {
			background-color: #ccc;
		}
		.panel-heading li:last-child {
			border-right: none;
		}
		.panel-heading li a:hover {
			text-decoration: none;
		}

		.table.table-bordered tbody td {
			vertical-align: baseline;
		}
	</style>
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
				<li><i class="fa fa-file-text-o"></i> All the current Posts</li>
				@can('.$p.$nombrecoNtrol.' Add'.$p.')
				<a href="#" id="massadd-modal" class="massmodal"><li>Añadir un '.$nombrecoNtrol.'</li></a>
				@endcan
			</ul>
		</div>
		<div class="panel-body" style="overflow-x:auto;">
			<table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
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
								<!--
								<th valign="middle">#</th>
								<th>Descripcion</th>
								<th>Tipo de solicitud?</th>
								<th>Estado de Solicitud?</th>
								<th>Nombre Ususario</th>
								<th>Ultima modificacion</th>
								<th>Accion</th>
								<th>Accion</th>
								-->
							</tr>
							{{ csrf_field() }}
						</thead>
						<tbody>


							@foreach($listmysql as $lists)
						  
								<tr class="item{{$lists->id}} @if($lists->is_published) warning @endif">
									'.$table2.'
									
									
									
									<td>{{ \Carbon\Carbon::createFromFormat('.$p.'Y-m-d H:i:s'.$p.', $lists->updated_at)->diffForHumans() }}</td>
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
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-descripcion"></h4>
				</div>
				<div class="modal-body">
					<h3 class="text-center" id="msdelete">¿Seguro que quieres borrar los  datos?</h3>
					<form class="form-horizontal" id="formmass" role="form">
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="id_mass"  disabled>
							</div>
						</div>
';

$form="";    
					foreach ($tables as  $value) {
					 // echo "@extends('layouts.app')";
					//$Tarea->descripcion = $request->descripcion;
						if ($value->Key=='PRI') {
							$form=$form."
							<!-- 
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>$value->Field:</label>
							<div class='col-sm-10'>
							-->
								<input type='hidden' class='form-control' id='".$value->Field."_mass' required='required' autofocus>
							<!--
								<p class='error$value->Field text-center alert alert-danger hidden'></p>
							</div>
						</div>
						-->
							";
						}else if($value->Key=='MUL'){
						
						$form=$form.'
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">'.$value->Field.':</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="'.$value->Field.'_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($'.$value->Field.' as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id='.$value->Field.'_mass" required="required" autofocus>
								-->
								<p class="error'.$value->Field.' text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
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
							<label class='control-label col-sm-2' for='descripcion'>$value->Field:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='".$value->Field."_mass' $left  $readonly required='required' autofocus>
								<p class='error$value->Field text-center alert alert-danger hidden'></p>
							</div>
						</div>
						";

						}
					}
//echo "$form";


$enve='                        

					
					</form>
					<div class="modal-footer">

						<button type="button" id="acciones" class="btn btn-primary mass" data-dismiss="modal">
							<span class="glyphicon glyphicon-check"></span> massar
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class="glyphicon glyphicon-remove"></span> Cerra
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ asset("toastr/toastr.min.js") }}"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@section("page-js-files")	
@stop	
@section("page-js-script")
	<!--
	<script>
		$(document).ready(function(){
	    	$("#postTable").DataTable();
		});

		$(window).load(function(){
			$("#postTable").removeAttr("style");
		})
	</script>
	-->
			
';
$enw="";
$enw=$enw.	"<script type='text/javascript'>
			";

		foreach ($tables as  $value) {
			if ($value->Key=="MUL") {
			$enw=$enw.'<?php echo "const  Fora'.$value->Field.'= $'.$value->Field.';"; ?>
			';				
			}
		}
		$enw=$enw.'</script>';

$enw=$enw."

	<script type='text/javascript'>
		 $(document).on('click','.massmodal', function() {
			$('.modal-descripcion').text('Añadir un nuevo Dato');
			$('#massModal').modal('show');
		});
		  // Show a post
		$(document).on('click', '.massshow-modal', function() {
			$('.modal-descripcion').text('Vista de los Datos');
			$('#msdelete').text(' ');
";
$dine="$";
			$formq="";
			foreach ($tables as  $value) {
			$formq=$formq."$dine('#".$value->Field."_mass').val($(this).data('$value->Field'));\n"; 
			}


$envt="
			$formq;
									
			
			$('#massModal').modal('show');
			$('#acciones').attr('class', 'btn btn-info hibe');
			$('#acciones').text('Visible');
			$('#acciones').attr('disabled');

		});
		// delete a post
		$(document).on('click', '.massdelete-modal', function() {
			$('.modal-descripcion').text('Eliminar los datos');
			$('#msdelete').text('¿Seguro que quieres borrar los datos?');

			
";
			
$envyq="
			$formq;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Delete');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: '$nombrecoNtrol/'+id,
				data: {
					'_token': $('input[name=_token]').val(),
				},
				success: function(data) {
					toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
					$('.item' + data['id']).remove();
					$('.col1').each(function (index) {
						$(this).html(index+1);
					});
				}
			});
		});
		// add a new post
		$(document).on('click', '.massmodal', function() {
			$('.modal-descripcion').text('Añadir un nuevo registro');
			$('#msdelete').text(' ');

			$('#massmodal').modal('show');
			$('#acciones').attr('class', 'btn btn-success add');
			//$('#formmass').attr('id', 'form_add');
			$('#acciones').text('Añadir Nuevos ');
		});
		$('.modal-footer').on('click', '.add', function() {
			$.ajax({
				type: 'POST',
				url: '$nombrecoNtrol',
				data: {
";
				$formq="";
				foreach ($tables as  $value) {
				$formq=$formq."'$value->Field': $('#".$value->Field."_mass').val(),"; 
				}

				$forms="";
				foreach ($tables as  $value) {
				$forms=$forms."$('.error".$value->Field."').addClass('hidden');"; 
				}

				$formd="";
				foreach ($tables as  $value) {
					
				$formd=$formd."if(data.errors.".$value->Field."){";
				$formd=$formd."$('.error".$value->Field."').removeClass('hidden');"; 
				$formd=$formd."$('.error".$value->Field."').text(data.errors.".$value->Field.");
				}"; 
				
				}


$envy="
				$formq
					'_token': $('input[name=_token]').val(),
				},
				error: function(jqXHR, text, error){
            	toastr.error('Validation error!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});
        		},
				success: function(data) { 
					$forms;
					if ((data.errors)) {
						setTimeout(function () {
							$('#massModal').modal('show');
							toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
						}, 500);
						$formd;
					} else {
						toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
						//var a = solicitudetipo.indexOf(data.id_tipo);
						//a++;
						//var e = solicitudestado.indexOf(data.id_estado);
						//e++;
						
//add
";

foreach ($tables as  $value) {			
				if ($value->Key=='MUL') {
			$envy=$envy.'const resul'.$value->Field.'=Fora'.$value->Field.'.find( cas => cas.id == data.'.$value->Field.' ); 
				';
				}
			}
$envy=$envy."			$('#postTable').append(";

$boto="";

	foreach ($tables as  $value) {
		if ($value->Key=="PRI") {			
			$boto=$boto.'"<tr class='.$p.'item"+data.'.$value->Field.'+"'.$p.'>"+
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
						$botones=$botones.'"'.$p.' data-'.$value->Field.'='.$p.'"+ data.'.$value->Field.'+
						';
	}

?>

<?php
$pp='"';
$p="'";
$ps="$pp$p";
$envu="
						$boto
						$p  <td>Ahorra</td><td> $p+
				@can('$nombrecoNtrol Show')
						$p <button class=".$pp."massshow-modal btn btn-success".$pp."  $p + 
						$botones 
						$pp$p><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  $pp+ 
				@endcan
				@can('$nombrecoNtrol Editar')

						$pp <button class='edit-modal btn btn-info' $pp+
						$botones 
						$pp$p><span class='glyphicon glyphicon-edit'></span> Editar</button> $p $pp+ 
				@endcan
				@can('$nombrecoNtrol Eliminar')		
						$pp $p <button class='massdelete-modal btn btn-danger' $p $pp +
						$botones 
						$pp$p><span class='glyphicon glyphicon-trash'></span> Eliminar</button>$p $pp+
				@endcan
						$pp $p</td></tr> $pp);

							



							
					
					}
				},
			});
		});
";
echo " ";
 echo "$botones";
echo " ";

$envd="
		// Edit a post
		$(document).on('click', '.edit-modal', function() {
			";
			foreach ($tables as $value) {
			$envd=$envd.'$("#'.$value->Field.'_mass").val($(this).data("'.$value->Field.'"));
			';
			}
$envd=$envd."

			id = $('#id_mass').val();
			$('#acciones').attr('class', 'btn btn-warning edit');
			$('#acciones').text('Editar');
			$('.modal-descripcion').text('Editar un Dato');
			$('#massModal').modal('show');
			$('#msdelete').text(' ');
		});

			";
$envd=$envd."


			$('.modal-footer').on('click', '.edit', function() {
				$.ajax({
					type: 'PUT',
					url: '$nombrecoNtrol/' + id,
					data: {
			";
			foreach ($tables as $value) {
				$envd=$envd."'$value->Field': $('#$value->Field"."_mass').val(),
			";
			}
$envd=$envd."'_token': $('input[name=_token]').val()
				}, 
			error: function(jqXHR, text, error){
            toastr.error('Validation error!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});	
        	},
			success: function(data) {
			";
			foreach ($tables as $value) {
			$envd=$envd."$('.error".$value->Field."').addClass('hidden');
			";	
			}
									
$envd=$envd."	 
			if ((data.errors)) {
				setTimeout(function () {
					//$('#editModal').modal('show');
					$('#massModal').modal('show');
					toastr.error('Validacion errorea!', 'Alerta de Error ', {timeOut: 5000});
				}, 500);
			";
			foreach ($tables as $value) {
			$envd=$envd.'
				if (data.errors.'.$value->Field.') {
                	$(".error'.$value->Field.'").removeClass("hidden");
                	$(".error'.$value->Field.'").text(data.errors.'.$value->Field.');
                }';
			}

$envd=$envd."
 				} else {
                	toastr.success('Successfully updated $nombrecoNtrol!', 'Success Alert', {timeOut: 5000});
                //update

			";
			foreach ($tables as  $value) {			
				if ($value->Key=='MUL') {
			$envd=$envd.'const resul'.$value->Field.'=Fora'.$value->Field.'.find( cas => cas.id == data.'.$value->Field.' ); 
				';
				}
			}
$envd=$envd."

				$('.item' + data.id).replaceWith(
";


		foreach ($tables as  $value) {
			if ($value->Key=="PRI") {
				
				$envd=$envd.'"<tr class='.$p.'item"+data.'.$value->Field.'+"'.$p.'>"+';
				$envd=$envd.'"<td class='.$p.'col1'.$p.'>" + data.'.$value->Field.' + "</td>"+
				';
				//"<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td>"+						
			}else{
				if ($value->Key=='MUL') {
				$envd=$envd.'"<td>"+ resul'.$value->Field.'["nombre"]  +"</td>"+
				';	
				}else{
				$envd=$envd.'"<td>"+ data.'.$value->Field.'+"</td>"+
				';
				}
			}
		}

	//$botones="";
	foreach ($tables as  $value) {
		//$botones=$botones.'"'.$p.'data-'.$value->Field.'='.$p.'"+ data.'.$value->Field.'+						';
	}
$envd=$envd."
			$p  <td>Ahorra</td><td> $p+			
			
			@can('$nombrecoNtrol Show') 
				$p <button class=".$pp."massshow-modal btn btn-success".$pp."  $p + 
				$botones 
				$pp$p><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  $pp+ 
			@endcan			
			
			@can('$nombrecoNtrol Editar')
				$pp <button class='edit-modal btn btn-info' $pp+
				$botones 
				$pp$p><span class='glyphicon glyphicon-edit'></span> Editar</button> $p $pp+ 
			@endcan

			@can('$nombrecoNtrol Eliminar') 
				$pp$p<button class='massdelete-modal btn btn-danger' $p $pp +
				$botones 
				$pp$p><span class='glyphicon glyphicon-trash'></span> Eliminar</button> $p $pp+
			@endcan
			$pp </td></tr> $pp);
					
				
";
$envd=$envd."


";
$envd=$envd."

  $('.edit_published').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'POST',
                                url: $pp{{ URL::route('changeStatus') }}$pp,
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    // empty
                                },
                            });
                        });
                       
                    }
                }
            });
        });

	</script>

@stop

</body>
</html>










";
//new
	//$directory = base_path()."/app2/directorio";
   	//File::makeDirectory($directory);

   	//$resultado = File::makeDirectory("/app2/appsss", 0775, true);
echo "





";


//$route=$nombrecoNtrol.

echo "Colocar el siguiente  codigo en Route web.php

";
echo "Route::get('$nombrecoNtrol/pdf', '".$nombrecoNtrol."Controller@pdf');
";
echo "Route::resource('$nombrecoNtrol','".$nombrecoNtrol."Controller');
";
echo "Route::post('$nombrecoNtrol/changeStatus', array('as' => 'changeStatus', 'uses' => '".$nombrecoNtrol."Controller@changeStatus'));

";
echo "<br><br>";


   	
   	$directorio = public_path().'/app2/'.$nombrecoNtrol;
   	$directorio = base_path().'/resources/views/'.$nombrecoNtrol;
	//if (!File::exists($directorio )) {
   	//$resultado = File::makeDirectory($directorio , 0777, true,true);
   	//$directorio = '/ruta/a/mi/carpeta';
	if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);

}


	file_put_contents(base_path().'/resources/views/'.$nombrecoNtrol.'/index.blade.php', $viewmarcos.$form.$enve.$enw.$envt.$envyq.$envy.$envu.$envd);
	//file_put_contents(base_path().'/app2/index.blade.php', $viewmarcos.$form.$enve.$enw.$envt.$envyq.$envy.$envu.$envd);
	$this->line('Controlador creado con exitos');
		  
	}
}