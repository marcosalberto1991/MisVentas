<?php

namespace App\Console\Commands;
use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;
use DB;

class NewController_3_2_vue extends Command
{
	/**
	* The name and signature of the console command.
	*
	* @var string
	*/
	//protected $signature = 'vista:new {user}';
	protected $signature = 'cru_vue:new ';


	/**
	* The console command description.
	*
	* @var string
	*/
	protected $description = 'Crear un CRUD V 3.2  Bootstrap 4.1 - Vue - 2019';

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
		//$nombrecoNtrol = $this->ask('Nombre de Namecontroller ej: "Consulta" => ConsultaNamecontroller.php ');
		$nombrecoNtrol="Factura";
		//$namedatabase = $this->ask('Nombre de la tabla en la base de datos  ');
		$namedatabase="factura";
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

		foreach ($tables as  $value) {
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

class '.$namecontrol.' extends Controller {
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

	public function create(){
    $data_foraneos = [
      '.$foranea_vue.'
      //"estados_id" => EstadoModel::select("id","nombre")->get(),
			//"users_id" => User::select("id","nombre")->get(),
		];
		return response()->json($data_foraneos);

  }

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
  public function show($id){
        return response()->json('.$NombreModel.'::findOrFail($id));
    }
  public function consulta(Request $request){
        $data='.$NombreModel.'::paginate(5);
        return response()->json($data);
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
    <div class='container'>
        <vue-$controlador_minuscula></vue-$controlador_minuscula>
    </div>
@endsection";

$vue_componete="";
$data="";

$vue_componete=$vue_componete."<template>
  <div>
    <div class='col-lg-12'>
      <nav>
        <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
      </nav>
      <nav class='nav'>
      <b-button v-b-modal.moda-registro @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>Añadir registro
      </b-button>
      </nav>
      <div class='panel-body' style='overflow-x:auto;'>
        <table class='table   table-striped table-bordered table-hover compact nowrap' id='myTable_' >
          <thead>
            <tr>
            ";
      
    $data="";
    $data_dt="";
    $input_data="";
    $input_sutmib="";
    $input_name="";
    foreach($tables as $value){
        $data = $data."<th>$value->Field</th>
        ";
        $data_dt = $data_dt."<td>{{data.$value->Field }}</td>
            ";
        $input_data = $input_data."input_$value->Field:[],
        ";
        $input_sutmib = $input_sutmib."this.input_$value->Field = data.$value->Field;
        ";
        $input_name = $input_name."$value->Field :this.input_$value->Field,
        ";


        //name: this.input_name
        

    }

$vue_componete=$vue_componete."
            $data
            <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for='data in datas' v-bind:key='data.id'>
        $data_dt
          <td>
            <b-button v-b-modal.moda-registro size='sm'
            variant='warning' @click='editar_registro(data.id)'
              type='button' class='btn btn-wangir btn-lg' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Editar
            </b-button>
            <b-button v-b-modal.moda-eliminar @click='eliminar_registro(data.id)'
              type='button' class='btn btn-danger btn-lg' size='sm' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Eliminar
            </b-button>

          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

";
//vista de modal 

$vue_componete=$vue_componete.'
<b-modal id="moda-registro"  size="xl" >
  <template slot="modal-title">{{mensaje_formulario}} </template>
    <!--
    <div v-if="editar_producto==true"><form ref="form" action v-on:submit.prevent="newproducto(venta.id)"></div>
    -->
    <div >
    </div>
    <form ref="form"   v-on:submit.prevent="formulario()">
      <div class="row"> 
        <div class="col-md-12">
          <input type="text" v-model="input_'.$nombrecoNtrol.'_id">   
';

      foreach ($tables as  $value) {
        if($value->Key=='MUL'){

          $vue_componete=$vue_componete.'
          <div class="form-group">
              <label for="exampleInputEmail1">'.$value->Field.'</label>
              <Select2
                class=""
                v-model="input_'.$value->Field.'"
                :options="data_foraneo_proveedor_id"
                :settings="{ settingOption: value, settingOption: value }"
              />
              <!--
              <Select2 v-model="input_'.$value->Field.'" 
                class="" id="exampleInputEmail1" 
                v-model="input_'.$value->Field.'"
                aria-describedby="emailHelp" placeholder="Seleccionar una opcion">
              
              />
              -->
              <small id="emailHelp" class="form-text text-muted"></small>
              <div v-if="errors && errors.'.$value->Field.'" class="text-danger">{{ errors.'.$value->Field.'[0] }}</div>
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

          <div class="form-group">
              <label for="exampleInputEmail1">'.$value->Field.'</label>
              <input type="text" v-model="input_'.$value->Field.'" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">Informacion de los datos</small>
              <div v-if="errors && errors.'.$value->Field.'" class="text-danger">{{ errors.'.$value->Field.'[0] }}</div>
          </div>
              ';


              }
        } 
        $vue_componete=$vue_componete.'


          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
  </form>
</b-modal>

<b-modal id="moda-eliminar"  size="xl" >
  <div class="d-block text-center">
  <!--  
  <input type="text" v-model="input_user_id">
  -->  
    <h3>¿Desea eliminar el registro permanente?</h3>
  </div>
  <b-button class="mt-3 btn btn-danger " @click="eliminar_registro_delete()">Eliminar</b-button>
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
  data() {

    return {
      validacion: [],
      editar_dato: false,
      data: [],
      datas: [],
      input_'.$nombrecoNtrol.'_id:[],
      '.$return_data.'
      '.$input_data.'
      consulta_datos: {},
      errors: {},
      mensaje_formulario: "",
      
    };
  },
  mounted() {
    //this.fetchArticles();
    this.consulta();
    axios.get("'.$nombrecoNtrol.'/create").then(response => {
      '.$data_foraneo.'
      //this.productos_all = response.data;
      //this.data_foraneo_estado_id = response.data.estado_id;
    });
    /*
    axios.get("productos_all").then(response => {
      this.productos_all = response.data;
    });
    axios.get("mesa/lista_mesa").then(response => {
      this.lista_mesa = response.data;
    });
    */
  },
  components: {
    VueSingleSelect,
    VueToastr2,
    Select2
  },
  methods: {
    /*
    axios.get('.$nombrecoNtrol.'/created).then(response => {
      this.productos_all = response.data;
    });
    */

    consulta(page = 1){
      axios.get("'.$nombrecoNtrol.'/consulta?page=" +page)
      .then(response => {
        this.consulta_datos = response.data;
        this.datas=response.data.data;
      });
    },
    eliminar_registro(data_id){
    this.input_'.$nombrecoNtrol.'_id=data_id;
    },
    eliminar_registro_delete(){
      var data_id=this.'.$input_id.';
      axios.delete('.$tilde_grave.'users/'.$peso.'{this.'.$input_id.'}'.$tilde_grave.').then(response => {
        const data = response.data;
        if(response.data.id){
              this.validacion="";
              this.$toastr.info("Operacio exitosa", "Datos Eliminados");
              this.consulta();
        }
      });
      
    },
    anadir_registro(){
      this.editar_dato = false;
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
              this.consulta();

            }
        },
        (err) => {
          console.log("Err", err);
            this.$toastr.warning(err, "Error en el servidor");
            this.$toastr.warning(err.message, "Error en el servidor");
        });

      }else{
        
        axios.post("users", data).then(response => {
            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta();

            }
        });

      }

    },
   
    editar_registro(data_id){//show 
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
   
  }
};


</script>



';






echo "Colocar el siguiente  codigo en Route web.php
";
echo "Route::get('$nombrecoNtrol/pdf', '".$nombrecoNtrol."Controller@pdf');
";
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