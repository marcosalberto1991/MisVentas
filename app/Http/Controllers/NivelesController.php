<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\NivelesModel;
use App\ZonaParqueaderoModel;
use App\SitiosParqueaderoUsuarioModel;

use App\EstadoModel;
use View;



use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class NivelesController extends Controller
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
	   			'codigo' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'zona_parqueadero_id' => 'required|min:1|max:99999999',
	   			'estado_id' => 'required|min:1|max:99999999',
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();
		$Sitios_Usuario=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->select('sitios_parqueadero_id')->get()->toArray();
		$zona_parqueadero_id = ZonaParqueaderoModel::wherein('id',[$Sitios_Usuario])->select('id')->get();


		$Niveles = NivelesModel::where('zona_parqueadero_id',$zona_parqueadero_id)->get();


		//$zona_parqueadero_id = ZonaParqueaderoModel::select("id","nombre")->get();
		$estado_id = EstadoModel::select("id","nombre")->get();
		   	
		return view('Niveles.index', [ "zona_parqueadero_id" => $zona_parqueadero_id,"estado_id" => $estado_id, 'listmysql' => $Niveles] );

	}
	public function lista($id){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		//$Niveles = NivelesModel::all();

		$Sitios_Usuario=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->select('sitios_parqueadero_id')->get()->toArray();
		$zona_parqueadero_id = ZonaParqueaderoModel::wherein('id',[$Sitios_Usuario])->select('id','nombre')->get();
		$zona_parqueadero = ZonaParqueaderoModel::wherein('id',[$Sitios_Usuario])->select('id')->get();
		

		$Niveles = NivelesModel::wherein('zona_parqueadero_id',$zona_parqueadero)->get();

		//$zona_parqueadero_id = ZonaParqueaderoModel::select("id","nombre")->get();
		   	$estado_id = EstadoModel::select("id","nombre")->get();
		   	
		return view('Niveles.index', [ "zona_parqueadero_id" => $zona_parqueadero_id,"estado_id" => $estado_id, 'listmysql' => $Niveles] );

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
			$Niveles = new NivelesModel();
			
			 $Niveles->nombre=$request->nombre;
				 $Niveles->codigo=$request->codigo;
				 $Niveles->zona_parqueadero_id=$request->zona_parqueadero_id;
				 $Niveles->estado_id=$request->estado_id;
				 //$Niveles->created_at=$request->created_at;
				 //$Niveles->updated_at=$request->updated_at;
				
			$Niveles->save();
			return response()->json($Niveles);
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
		$Niveles = NivelesModel::findOrFail($id);

		return view('Niveles.show', ['NivelesModel' => $Niveles]);
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
			$Niveles = NivelesModel::findOrFail($id);
			
			 $Niveles->nombre=$request->nombre;
				 $Niveles->codigo=$request->codigo;
				 $Niveles->zona_parqueadero_id=$request->zona_parqueadero_id;
				 $Niveles->estado_id=$request->estado_id;
				 //$Niveles->created_at=$request->created_at;
				 //$Niveles->updated_at=$request->updated_at;
				
		  
			$Niveles->save();
			return response()->json($Niveles);
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
		$Niveles = NivelesModel::findOrFail($id);
		$Niveles->delete();
		return response()->json($Niveles);
	}


	/**
	* Change resource status. NivelesModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$Niveles = NivelesModel::findOrFail($id);
		$Niveles->is_published = !$NivelesModel->is_published;
		$Niveles->save();

		return response()->json($Niveles);
	}
}


