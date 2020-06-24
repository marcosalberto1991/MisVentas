<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\ZonaParqueaderoModel;
use App\EstadoModel;
use App\SitiosParqueaderoUsuarioModel;

use App\SitiosParqueaderoModel;
use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class ZonaParqueaderoController extends Controller
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
	   			'sitios_parqueadero_id' => 'required|min:1|max:99999999',
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
		$ZonaParqueadero = ZonaParqueaderoModel::wherein('id',[$Sitios_Usuario])->get();

		$sitios_parqueadero_id = SitiosParqueaderoModel::select("id","nombre")->wherein('id',[$Sitios_Usuario])->get();
		   	$estado_id = EstadoModel::select("id","nombre")->get();
		   	
		return view('ZonaParqueadero.index', [ "sitios_parqueadero_id" => $sitios_parqueadero_id,"estado_id" => $estado_id, 'listmysql' => $ZonaParqueadero] );

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
			$ZonaParqueadero = new ZonaParqueaderoModel();
			
			 $ZonaParqueadero->nombre=$request->nombre;
				 $ZonaParqueadero->sitios_parqueadero_id=$request->sitios_parqueadero_id;
				 //$ZonaParqueadero->created_at=$request->created_at;
				 //$ZonaParqueadero->updated_at=$request->updated_at;
				 $ZonaParqueadero->estado_id=$request->estado_id;
				
			$ZonaParqueadero->save();
			return response()->json($ZonaParqueadero);
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
		$ZonaParqueadero = ZonaParqueaderoModel::findOrFail($id);

		return view('ZonaParqueadero.show', ['ZonaParqueaderoModel' => $ZonaParqueadero]);
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
			$ZonaParqueadero = ZonaParqueaderoModel::findOrFail($id);
			
			 $ZonaParqueadero->nombre=$request->nombre;
				 $ZonaParqueadero->sitios_parqueadero_id=$request->sitios_parqueadero_id;
				 //$ZonaParqueadero->created_at=$request->created_at;
				 //$ZonaParqueadero->updated_at=$request->updated_at;
				 $ZonaParqueadero->estado_id=$request->estado_id;
				
		  
			$ZonaParqueadero->save();
			return response()->json($ZonaParqueadero);
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
		$ZonaParqueadero = ZonaParqueaderoModel::findOrFail($id);
		$ZonaParqueadero->delete();
		return response()->json($ZonaParqueadero);
	}


	/**
	* Change resource status. ZonaParqueaderoModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$ZonaParqueadero = ZonaParqueaderoModel::findOrFail($id);
		$ZonaParqueadero->is_published = !$ZonaParqueaderoModel->is_published;
		$ZonaParqueadero->save();

		return response()->json($ZonaParqueadero);
	}
}


