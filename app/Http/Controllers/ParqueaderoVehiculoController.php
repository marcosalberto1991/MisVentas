<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\ParqueaderoVehiculoModel;
use App\SitiosParqueaderoUsuarioModel;
use App\ZonaParqueaderoModel;
use App\CategoriaParqueaderoModel;
use App\TipoVehiculoModel;
use App\EstadoModel;



use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class ParqueaderoVehiculoController extends Controller
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
	   			'numero' => 'required|min:1|max:99999999',
	   			//'codigo' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'categoria_parqueadero_id' => 'required|min:1|max:99999999',
	   			'tipo_vehiculo_id' => 'required|min:1|max:99999999',
	   			'estado_id' => 'required|min:1|max:99999999',
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		$Sitios_Usuario=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->select('sitios_parqueadero_id')->get()->toArray();
		$zona_parqueadero_id = ZonaParqueaderoModel::wherein('id',[$Sitios_Usuario])->select('id')->get();
		$categoria_parqueadero_id=CategoriaParqueaderoModel::wherein('zona_parqueadero_sitios_parqueadero_id',$Sitios_Usuario)->select('id')->get();
		$ParqueaderoVehiculo = ParqueaderoVehiculoModel::wherein('categoria_parqueadero_id',$categoria_parqueadero_id)->get();
		$categoria_parqueadero_id = CategoriaParqueaderoModel::wherein('zona_parqueadero_sitios_parqueadero_id',$Sitios_Usuario)->select("id","letra as nombre")->get();
		   	$tipo_vehiculo_id = TipoVehiculoModel::select("id","nombre")->where('sitios_parqueadero_id',$Sitios_Usuario)->get();
		   	$estado_id = EstadoModel::select("id","nombre")->get();
		   	
		return view('ParqueaderoVehiculo.index', [ "categoria_parqueadero_id" => $categoria_parqueadero_id,"tipo_vehiculo_id" => $tipo_vehiculo_id,"estado_id" => $estado_id, 'listmysql' => $ParqueaderoVehiculo] );

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

	public function FunctionName($value='')
	{
	 	# code...
	} 
	public function store(Request $request)
	{
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$ParqueaderoVehiculo = new ParqueaderoVehiculoModel();


			$categoria_parqueadero_id=CategoriaParqueaderoModel::with('niveles_id_pk')->where('id',$request->categoria_parqueadero_id)->first();
			$niveles = $categoria_parqueadero_id->niveles_id_pk->codigo;
			$letra = $categoria_parqueadero_id->letra;
			
			$codigo="$niveles-$letra-$request->numero ";
			$ParqueaderoVehiculo->codigo=$codigo;
			$ParqueaderoVehiculo->numero=$request->numero;
			$ParqueaderoVehiculo->categoria_parqueadero_id=$request->categoria_parqueadero_id;
			$ParqueaderoVehiculo->tipo_vehiculo_id=$request->tipo_vehiculo_id;
			$ParqueaderoVehiculo->estado_id=$request->estado_id;
			//$ParqueaderoVehiculo->created_at=$request->created_at;
			//$ParqueaderoVehiculo->updated_at=$request->updated_at;
				
			$ParqueaderoVehiculo->save();
			return response()->json($ParqueaderoVehiculo);
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
		$ParqueaderoVehiculo = ParqueaderoVehiculoModel::findOrFail($id);

		return view('ParqueaderoVehiculo.show', ['ParqueaderoVehiculoModel' => $ParqueaderoVehiculo]);
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
			$ParqueaderoVehiculo = ParqueaderoVehiculoModel::findOrFail($id);
			
			$categoria_parqueadero_id=CategoriaParqueaderoModel::with('niveles_id_pk')->where('id',$request->categoria_parqueadero_id)->first();
			$niveles = $categoria_parqueadero_id->niveles_id_pk->codigo;
			$letra = $categoria_parqueadero_id->letra;
			
			$codigo="$niveles-$letra-$request->numero ";
			$ParqueaderoVehiculo->codigo=$codigo;
			//$ParqueaderoVehiculo->codigo=$request->codigo;
			$ParqueaderoVehiculo->numero=$request->numero;
			$ParqueaderoVehiculo->categoria_parqueadero_id=$request->categoria_parqueadero_id;
			$ParqueaderoVehiculo->tipo_vehiculo_id=$request->tipo_vehiculo_id;
			$ParqueaderoVehiculo->estado_id=$request->estado_id;
			//$ParqueaderoVehiculo->created_at=$request->created_at;
			//$ParqueaderoVehiculo->updated_at=$request->updated_at;
				
		  
			$ParqueaderoVehiculo->save();
			return response()->json($ParqueaderoVehiculo);
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
		$ParqueaderoVehiculo = ParqueaderoVehiculoModel::findOrFail($id);
		$ParqueaderoVehiculo->delete();
		return response()->json($ParqueaderoVehiculo);
	}


	/**
	* Change resource status. ParqueaderoVehiculoModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$ParqueaderoVehiculo = ParqueaderoVehiculoModel::findOrFail($id);
		$ParqueaderoVehiculo->is_published = !$ParqueaderoVehiculoModel->is_published;
		$ParqueaderoVehiculo->save();

		return response()->json($ParqueaderoVehiculo);
	}
}


