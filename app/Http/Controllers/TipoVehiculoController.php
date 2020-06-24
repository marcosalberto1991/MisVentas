<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\TipoVehiculoModel;
use App\SitiosParqueaderoUsuarioModel;

use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class TipoVehiculoController extends Controller
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
	   			'nombre' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'precio_minutos' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			
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
		$TipoVehiculo = TipoVehiculoModel::where('sitios_parqueadero_id',$sitios_parqueadero_id)->get();

		
		return view('TipoVehiculo.index', [  'listmysql' => $TipoVehiculo] );

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

		//	$sitio_parqueadero=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->select('sitios_parqueadero_id')->get()->first();
			$sitio_parqueadero=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->first();
			$sitios_parqueadero_id=$sitio_parqueadero->sitios_parqueadero_id;
			$TipoVehiculo = new TipoVehiculoModel();
			
			$TipoVehiculo->sitios_parqueadero_id=$sitios_parqueadero_id;
			$TipoVehiculo->nombre=$request->nombre;
			$TipoVehiculo->precio_minutos=$request->precio_minutos;
			//$TipoVehiculo->created_at=$request->created_at;
			//$TipoVehiculo->updated_at=$request->updated_at;
				
			$TipoVehiculo->save();
			return response()->json($TipoVehiculo);
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
		$TipoVehiculo = TipoVehiculoModel::findOrFail($id);

		return view('TipoVehiculo.show', ['TipoVehiculoModel' => $TipoVehiculo]);
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
			$TipoVehiculo = TipoVehiculoModel::findOrFail($id);
			
			$TipoVehiculo->nombre=$request->nombre;
			$TipoVehiculo->precio_minutos=$request->precio_minutos;


			//$TipoVehiculo->created_at=$request->created_at;
			//$TipoVehiculo->updated_at=$request->updated_at;
				
		  
			$TipoVehiculo->save();
			return response()->json($TipoVehiculo);
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
		$TipoVehiculo = TipoVehiculoModel::findOrFail($id);
		$TipoVehiculo->delete();
		return response()->json($TipoVehiculo);
	}


	/**
	* Change resource status. TipoVehiculoModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$TipoVehiculo = TipoVehiculoModel::findOrFail($id);
		$TipoVehiculo->is_published = !$TipoVehiculoModel->is_published;
		$TipoVehiculo->save();

		return response()->json($TipoVehiculo);
	}
}


