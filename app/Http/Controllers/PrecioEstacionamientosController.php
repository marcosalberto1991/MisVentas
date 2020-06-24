<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\PrecioEstacionamientosModel;
use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class PrecioEstacionamientosController extends Controller
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
				'id' => 'required|min:1|max:99999999',
	   			'nombre' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'precio' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'tiempo' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'tipo_vehiculo_id' => 'required|min:1|max:99999999',
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$PrecioEstacionamientos = PrecioEstacionamientosModel::all();

		$tipo_vehiculo_id = PrecioEstacionamientosModel::select("id","id as nombre")->get();
		   	
		return view('PrecioEstacionamientos.index', [ "tipo_vehiculo_id" => $tipo_vehiculo_id, 'listmysql' => $PrecioEstacionamientos] );

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
			$PrecioEstacionamientos = new PrecioEstacionamientosModel();
			
			 $PrecioEstacionamientos->nombre=$request->nombre;
				 $PrecioEstacionamientos->precio=$request->precio;
				 $PrecioEstacionamientos->tiempo=$request->tiempo;
				 $PrecioEstacionamientos->tipo_vehiculo_id=$request->tipo_vehiculo_id;
				 $PrecioEstacionamientos->created_at=$request->created_at;
				 $PrecioEstacionamientos->updated_at=$request->updated_at;
				
			$PrecioEstacionamientos->save();
			return response()->json($PrecioEstacionamientos);
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
		$PrecioEstacionamientos = PrecioEstacionamientosModel::findOrFail($id);

		return view('PrecioEstacionamientos.show', ['PrecioEstacionamientosModel' => $PrecioEstacionamientos]);
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
			$PrecioEstacionamientos = PrecioEstacionamientosModel::findOrFail($id);
			
			 $PrecioEstacionamientos->nombre=$request->nombre;
				 $PrecioEstacionamientos->precio=$request->precio;
				 $PrecioEstacionamientos->tiempo=$request->tiempo;
				 $PrecioEstacionamientos->tipo_vehiculo_id=$request->tipo_vehiculo_id;
				 $PrecioEstacionamientos->created_at=$request->created_at;
				 $PrecioEstacionamientos->updated_at=$request->updated_at;
				
		  
			$PrecioEstacionamientos->save();
			return response()->json($PrecioEstacionamientos);
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
		$PrecioEstacionamientos = PrecioEstacionamientosModel::findOrFail($id);
		$PrecioEstacionamientos->delete();
		return response()->json($PrecioEstacionamientos);
	}


	/**
	* Change resource status. PrecioEstacionamientosModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$PrecioEstacionamientos = PrecioEstacionamientosModel::findOrFail($id);
		$PrecioEstacionamientos->is_published = !$PrecioEstacionamientosModel->is_published;
		$PrecioEstacionamientos->save();

		return response()->json($PrecioEstacionamientos);
	}
}


