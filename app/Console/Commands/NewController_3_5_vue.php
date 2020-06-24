<?php

namespace App\Console\Commands;
use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;
use DB;

class NewController_3_5_vue extends Command
{
	/**
	* The name and signature of the console command.
	*
	* @var string
	*/
	//protected $signature = 'vista:new {user}';
	protected $signature = 'crud_vue_3_5:new ';


	/**
	* The console command description.
	*
	* @var string
	*/
	protected $description = 'Crear un CRUD V 3.5  Bootstrap 4.1 - Vue - 2019-11';

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
		$this->line('Creacion de un CRUD version 3.3 - vue boosrtra 4 ');
		$this->line('ConsultaNamecontroller.php');
		$nombrecoNtrol = $this->ask('Nombre de Namecontroller ej: "Consulta" => ConsultaNamecontroller.php ');
		//$nombrecoNtrol="Proyecto_prueba";
		$namedatabase = $this->ask('Nombre de la tabla en la base de datos  ');
		$is_subir_archivo = $this->ask('configura para subir archivos (S/N) ');
		//$namedatabase="proyecto";
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
    use OwenIt\Auditing\Contracts\Auditable;

	class '.$NombreModel.' extends Model implements Auditable {
        use \OwenIt\Auditing\Auditable;
		protected $table = '.$p.$namedatabase.$p.';
    protected $fillable = [];
    //public $timestamps = false;
    /*
    public function tipo_factura_id_pk(){
      return $this->belongsTo('.$p.'App\Tipo_FacturaModel'.$p.', '.$p.'tipo_factura_id'.$p.');
    }
    public function cartera_lista_all(){
      return $this->HasMany('.$p.'App\Cartera_ListaModel'.$p.', '.$p.'cartera_sam_id'.$p.');
    }
    */
	}';	
	
	file_put_contents(base_path().'/app/'.$NombreModel.'.php', $envss);


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

		
		  //echo "data  $value->Field \n ";

		}
		//echo "$consultaBD";
		$foranea="";
		$foranea_vue="";
		$foraneaVi="";
    $consulta_data_like="";
		foreach ($tables as  $value) {

      $consulta_data_like=$consulta_data_like.'->orwhere("'.$value->Field.'","like","%". $consulta_data."%")
        ';

		   	if ($value->Key=="MUL") {
		   	
		   	$foranea=$foranea.'$'.$value->Field.' = '.$NombreModel.'::select("id","id as nombre")->get();
        ';
        $foranea_vue=$foranea_vue.'"'.$value->Field.'" => '.$NombreModel.'::select("id","id as nombre","id as text")->get(),
        ';
        //"estados_id" => EstadoModel::select("id","nombre")->get(),

         

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
	   			$validar=$validar."'$value->Field' => 'required|min:2|max:255',
	   			";
	   		}else{
          $validar=$validar."'$value->Field' => 'required|min:2|max:255',
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

class '.$namecontrol.' extends Controller {
	public function __construct(){
		$this->middleware('.$p.'auth'.$p.');
	}
	   
	protected $rules =
	[
    '.$validar.'
    //regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/
    
	];

	public function index(){
		return view('.$p.''.$nombrecoNtrol.'.index'.$p.', [] );
  }
  public function consulta(Request $request){
    $consulta_data=$request->get("consulta_data");
    if($consulta_data==""){
      $data='.$NombreModel.'::paginate(20);
    }else{
      $data='.$NombreModel.'::where("id",1)
      '.$consulta_data_like.'
      ->paginate(20);
    } 
    
    return response()->json($data);
  }
	public function create(){
    $data_foraneos = [
      '.$foranea_vue.'
      //"departamento_id" => DepartamentoModel::select("id_departamento as id","departamento as text")->get(),
		];
		return response()->json($data_foraneos);

  }

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('.$p.'errors'.$p.' => $validator->getMessageBag()->toArray()));
		} else {
     
      /*
      $file2 = Input::file('.$p.'archivo'.$p.');
			if (isset($file2)) {
				$codigo=str_random(5);
				$nombre_original=$file2->getClientOriginalName();
				$nombres = $nombre_original.$codigo. '.$p.'.'.$p.' . $file2->getClientOriginalExtension();
        \Storage::disk('.$p.'intervenir'.$p.')->put($nombres, \File::get($file2));
      }
      */
      
      $'.$nombrecoNtrol.' = new '.$NombreModel.'();
			
			'.$consultaBD.'
			$'.$nombrecoNtrol.'->save();
			return response()->json($'.$nombrecoNtrol.');
		}
	}
  public function show($id){
        return response()->json('.$NombreModel.'::findOrFail($id));
    }
  

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

$vue_vista="";

$controlador_minuscula = strtolower($nombrecoNtrol);
$vue_vista=$vue_vista."@extends('layouts.App_admin_ui')
@section('content')
   
        <vue-$controlador_minuscula></vue-$controlador_minuscula>
   
@endsection";

$vue_componete="";
$data="";
$pp='"';

$data="";
    $data_dt="";
    $input_data="";
    $input_sutmib="";
    $input_name="";
    $input_clear="";
    $input_fields="";


    foreach($tables as $value){
      $data = $data."<th>$value->Field</th>
      ";
      //$data_dt = $data_dt."<td>{{data.$value->Field }}</td>
       //   ";
      $input_data = $input_data."input_$value->Field:[],
      //";
      $input_sutmib = $input_sutmib."this.input_$value->Field = data.$value->Field;
              ";
      $input_name = $input_name."$value->Field :this.input_$value->Field,
        ";
      $input_clear = $input_clear."this.input_$value->Field = '';
      ";
      $input_fields = $input_fields."{ key: '$value->Field', sortable:true},
      ";
      //{ key: 'primer_nombre', sortable: true },



      //name: this.input_name
      

  }

$can='"$can';
$vue_componete=$vue_componete.'<template>
<div class="row">
    <div v-if="formulario_'.$nombrecoNtrol.'" class="col-lg-12 ">
        <div class="main-card mb-3 card formulario">
            <div class="card-body"><h1 class="card-title"></h1>
                  <h2>Formulario </h2>
                    <div class="col-md-12 row">
                      <div class="form-group col-md-12 col-sm-12" style="margin-bottom: 6px;">
                        <button type="submit"  @click="formulario()" class="btn btn-primary">Guardar </button> 
                        <a class="btn btn-warning" @click="cancelar_registro()" >Cancelar</a>
                      </div>
                    </div>
                    <div class="col-lg-12">

      <form ref="form"   v-on:submit.prevent="formulario()">
        <div class="row"> 
          <div class="col-md-12 row">
            <input type="hidden" v-model="input_'.$nombrecoNtrol.'_id">   
  ';

  
        foreach ($tables as  $value) {
          if($value->Key=='MUL'){
  
            $vue_componete=$vue_componete.'
            <div class="form-group col-md-4 col-sm-12">
              <label for="exampleInputEmail1">'.$value->Field.'</label>
              <Select2 v-model="input_'.$value->Field.'" :options="data_foraneo_'.$value->Field.'" :settings="{ settingOption: value, settingOption: value }"/>
              <small id="emailHelp" class="form-text text-muted"></small>
              <b-alert show  v-if="validacion.'.$value->Field.'" variant="danger" >{{validacion.'.$value->Field.'[0]}}</b-alert>
            </div>
          ';
            }else{
                if($value->Type=="timestamp") {
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
  
                $vue_componete=$vue_componete.'
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>'.$value->Field.'</b></label>
                <input type="text" v-model="input_'.$value->Field.'" placeholder="'.$value->Field.'" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.'.$value->Field.'" variant="danger" >{{validacion.'.$value->Field.'[0]}}</b-alert>
                
            </div>
                ';
  
  
                }
          } 
          $vue_componete=$vue_componete.'
            <div class="form-group col-md-12 col-sm-12 text-center">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </div>
        </div>
      </form>
      </div>    
      </div>
  </div>
</div>
';

  $vue_componete=$vue_componete."

  <div v-else class='col-lg-12'>
  <div class='main-card mb-3 card'>
  <div class='card-body'><h1 class=''>Lista de ".$nombrecoNtrol." </h1>  
  
    <nav>
      <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
    </nav>
      
    <div class='col-12'>
      <b-button v-if=$can('$nombrecoNtrol Anadir')$pp  @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>Añadir registro
      </b-button>
      <div class='flexbox  float-right' >
        <form ref='form'    v-on:submit.prevent='consulta()'>
          <b-input-group size='sm' class='float-right  margin-bottom-0' prepend=''  style='margin-bottom: 0px;'>
            <b-form-input type='text' v-model='input_consulta_data' ></b-form-input>
            <b-input-group-append>
              <b-button @click='consulta()' size='sm' text='Button' variant='success'>Buscar</b-button>
            </b-input-group-append>
          </b-input-group>
        </form>
      </div><br><br>
    </div>
      
      <b-table :items='consulta_tabla' :fields='fields' 
      responsive='sm' :sticky-header='stickyHeader' :no-border-collapse='noCollapse'>
      <template v-slot:cell(Acciones)='data'>

          <b-button-group>
            <b-button v-if=$can('$nombrecoNtrol Editar')$pp  v-b-modal.moda-registro size='sm' variant='warning' @click='editar_registro(data.item.id)' type='button' class='btn-sm btn btn-wangir mr-1' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Editar
            </b-button>
            <b-button v-if=$can('$nombrecoNtrol Eliminar')$pp  v-b-modal.moda-eliminar @click='eliminar_registro(data.item.id)'
                type='button' class='btn-sm btn btn-danger mr-1' size='sm' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Eliminar
            </b-button>
            <!--  
            <a v-bind:href=$pp data.item.id+'/Sucursale'$pp  class='btn-sm btn btn-success mr-1' size='sm'  style='margin-bottom: 5px; margin: 5px;'>Surcusales </a>
            -->
          </b-button-group>

        


        </template>
        <template v-slot:head(Acciones)='scope'>
          <div class='text-nowrap'>Acciones</div>
        </template>
      </b-table>
            ";
$vue_componete=$vue_componete.'
</div>
</div>
</div>




<b-modal id="moda-eliminar"  size="xl" hide-footer >
  <template slot="modal-title">Eliminar un Registro </template>
  <div class="d-block text-center">
    <h3>¿Desea eliminar el registro permanente?</h3>
    <b-button class="mt-3 btn btn-danger " @click="eliminar_registro_delete()">Eliminar</b-button>
  </div>
</b-modal>


</div>
</template>
';

$peso='$';
$toastr='$toastr';
$tilde_grave='`';
$input_id ='input_'.$nombrecoNtrol.'_id';
$data_foraneo='';
$return_data='';

//$his='this';
foreach ($tables as  $value) {
  
  if($value->Key=='MUL'){
    
   $data_foraneo =$data_foraneo.'this.data_foraneo_'.$value->Field.'= response.data.'.$value->Field.'
        ';
   $return_data = $return_data.'data_foraneo_'.$value->Field.':[],';
   //input_id:[],

  }
}



$vue_componete=$vue_componete.'



<script type="application/javascript">
import Vue from "vue";
import VueSingleSelect from "vue-single-select";

//import VueToast from "vue-toast-notification";
//import "vue-toast-notification/dist/index.css";
import Select2 from "v-select2-component";
//https://www.npmjs.com/package/vue-toastr-2
import VueToastr2 from "vue-toastr-2";
import "vue-toastr-2/dist/vue-toastr-2.min.css";
window.toastr = require("toastr");
Vue.use(VueToastr2);

export default {
  components: {
    VueSingleSelect,
    VueToastr2,
    Select2
  },
  data() {

    return {
      formulario_'.$nombrecoNtrol.':false,
      validacion: [],
      editar_dato: false,
      data: [],
      datas: [],
      input_consulta_data:"",
      stickyHeader: true,
      noCollapse: false,
      fields: [
      { key: "Acciones",stickyColumn: true, label:"Acciones" ,sortable: false },
      '.$input_fields.'
      ],


      input_'.$nombrecoNtrol.'_id:[],
      '.$return_data.'
      '.$input_data.'
      consulta_tabla:[],
      consulta_datos: {},
      errors: {},
      mensaje_formulario: "",
      page:1,
      
    };
  },
  mounted() {
    this.consulta();
    this.data_foraneo();
  },
  methods: {
    
    consulta(page = 1){
      this.page=page;
      axios.get("'.$nombrecoNtrol.'/consulta?page=" +page+"&consulta_data="+this.input_consulta_data)
      .then(response => {
        this.consulta_datos = response.data;
        this.datas=response.data.data;
        this.items=response.data.data;
        this.consulta_tabla=response.data.data;
      });
    },
    data_foraneo(){
      axios.get("'.$nombrecoNtrol.'/create").then(response => {
        this.productos_all = response.data;
        '.$data_foraneo.'
      });
    },
    eliminar_registro(data_id){
    this.input_'.$nombrecoNtrol.'_id=data_id;
    },
    eliminar_registro_delete(){
      var data_id=this.'.$input_id.';
      axios.delete('.$tilde_grave.''.$nombrecoNtrol.'/'.$peso.'{this.'.$input_id.'}'.$tilde_grave.').then(response => {
        const data = response.data;
        if(response.data.id){
          this.validacion="";
          this.$toastr.info("Operacio exitosa", "Datos Eliminados");
          this.consulta(this.page);
        }
      });
      
    },
    anadir_registro(){
      this.validacion="";
      this.formulario_'.$nombrecoNtrol.'=true;
      this.editar_dato = false;
      this.limpiar_form();
      this.mensaje_formulario="Añadir un nuevo registro"
    },
    formulario(){

      const data = {
        id: this.'.$input_id.',
        '.$input_name.'
        //name: this.input_name,
        //email: this.input_email
      };
      
      if(this.editar_dato == true){
        axios.put('.$tilde_grave.''.$nombrecoNtrol.'/'.$peso.'{this.'.$input_id.'}'.$tilde_grave.', data)
        .then(response => {

            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta(this.page);
              this.formulario_'.$nombrecoNtrol.'=false;


            }
        },
        (err) => {
          console.log("Err", err);
            this.$toastr.warning(err, "Error en el servidor");
            this.$toastr.warning(err.message, "Error en el servidor");
        });

      }else{
        
        axios.post("'.$nombrecoNtrol.'", data).then(response => {
            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta(this.page);
              this.formulario_'.$nombrecoNtrol.'=false;
              this.limpiar_form();


            }
        },
        (err) => {
          console.log("Err", err);
            this.$toastr.warning(err, "Error en el servidor");
            this.$toastr.warning(err.message, "Error en el servidor");
        }
      
        );

      }

    },
    cancelar_registro(){
      this.formulario_'.$nombrecoNtrol.'=false;
    },
    $can(permissionName) {
      return Permissions.indexOf(permissionName) !== -1;
    },
    editar_registro(data_id){//show 
      this.validacion="";
      this.formulario_'.$nombrecoNtrol.'=true;  
      this.mensaje_formulario="Editar un registro"
        axios.get('.$tilde_grave.''.$nombrecoNtrol.'/'.$peso.'{data_id}'.$tilde_grave.').then(response => {
            const data = response.data;
            if(!response.data){
              this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
            }else{
              this.$toastr.success("Operacio exitosa", "Regitro obtenido");
              this.editar_dato = true;
              this.input_'.$nombrecoNtrol.'_id = data.id
              '.$input_sutmib.'
              //this.input_user_id = data.id;
              //this.input_name = data.name;
            }
        });
    },
    limpiar_form(){
      '.$input_clear.'
      this.validacion="";

    },
   
  }
};


</script>



';






echo "Colocar el siguiente  codigo en Route web.php
";
echo "Route::get('$nombrecoNtrol/consulta', '".$nombrecoNtrol."Controller@consulta');
";
//Route::get('Mi_carrito/consulta', 'Mi_carritoController@consulta');
echo "Route::resource('$nombrecoNtrol','".$nombrecoNtrol."Controller');
";

echo "Vue.component('vue-".$controlador_minuscula."', require('./components/vue-".$nombrecoNtrol.".vue'));
";



echo "<br><br>";

   	$directorio = base_path().'/resources/views/'.$nombrecoNtrol;
	if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }

	file_put_contents(base_path().'/resources/views/'.$nombrecoNtrol.'/index.blade.php', $vue_vista);
	file_put_contents(base_path().'/resources/assets/js/components/vue-'.$nombrecoNtrol.'.vue', $vue_componete);
	//file_put_contents(base_path().'/resources/views/'.$nombrecoNtrol.'/index.blade.php', $viewmarcos.$form.$enve.$enw.$envy.$envd);
	//file_put_contents(base_path().'/app2/index.blade.php', $viewmarcos.$form.$enve.$enw.$envt.$envyq.$envy.$envu.$envd);
	$this->line('Controlador creado con exitos');
		  
	}
}