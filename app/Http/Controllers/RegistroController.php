<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\RegistroModel;
use App\ParqueaderoVehiculoModel;
use App\SitiosParqueaderoUsuarioModel;




use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class RegistroController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	   


	}
	/**
	* @var array
	*/
	protected $rules =
	[
		
				//'id' => 'required|min:1|max:99999999',
	   			'cosecutivo' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'fecha_ingreso' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'valor_pagado' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'parqueadero_vehiculo_id' => 'required|min:1|max:99999999',
	   			'placa_vehiculo' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'precio_estacionamiento' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'user_id' => 'required|min:1|max:99999999',
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();
		$sitio_parqueadero=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->first();
		$sitios_parqueadero_id=$sitio_parqueadero->sitios_parqueadero_id;

		$Registro = RegistroModel::where('sitios_parqueadero_id',$sitios_parqueadero_id)->get();

		$parqueadero_vehiculo_id = ParqueaderoVehiculoModel::select("id","codigo as nombre")->get();
		   	$user_id = User::select("id","name as nombre")->get();
		   	
		return view('Registro.index', [ "parqueadero_vehiculo_id" => $parqueadero_vehiculo_id,"user_id" => $user_id, 'listmysql' => $Registro] );

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
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Registro = new RegistroModel();
			
			 $Registro->cosecutivo=$request->cosecutivo;
				 $Registro->fecha_ingreso=$request->fecha_ingreso;
				 $Registro->fecha_salida=$request->fecha_salida;
				 $Registro->fecha_pago=$request->fecha_pago;
				 $Registro->updated_at=$request->updated_at;
				 $Registro->created_at=$request->created_at;
				 $Registro->valor_pagado=$request->valor_pagado;
				 $Registro->parqueadero_vehiculo_id=$request->parqueadero_vehiculo_id;
				 $Registro->placa_vehiculo=$request->placa_vehiculo;
				 $Registro->precio_estacionamiento=$request->precio_estacionamiento;
				 $Registro->user_id=$request->user_id;
				
			$Registro->save();
			return response()->json($Registro);
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
		$Registro = RegistroModel::findOrFail($id);

		return view('Registro.show', ['RegistroModel' => $Registro]);
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
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Registro = RegistroModel::findOrFail($id);
			
			 $Registro->cosecutivo=$request->cosecutivo;
				 $Registro->fecha_ingreso=$request->fecha_ingreso;
				 $Registro->fecha_salida=$request->fecha_salida;
				 $Registro->fecha_pago=$request->fecha_pago;
				 $Registro->updated_at=$request->updated_at;
				 $Registro->created_at=$request->created_at;
				 $Registro->valor_pagado=$request->valor_pagado;
				 $Registro->parqueadero_vehiculo_id=$request->parqueadero_vehiculo_id;
				 $Registro->placa_vehiculo=$request->placa_vehiculo;
				 $Registro->precio_estacionamiento=$request->precio_estacionamiento;
				 $Registro->user_id=$request->user_id;
				
		  
			$Registro->save();
			return response()->json($Registro);
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
		$Registro = RegistroModel::findOrFail($id);
		$Registro->delete();
		return response()->json($Registro);
	}


	/**
	* Change resource status. RegistroModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$Registro = RegistroModel::findOrFail($id);
		$Registro->is_published = !$RegistroModel->is_published;
		$Registro->save();

		return response()->json($Registro);
	}
}


