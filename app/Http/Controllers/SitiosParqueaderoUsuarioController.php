<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\SitiosParqueaderoUsuarioModel;
use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class SitiosParqueaderoUsuarioController extends Controller
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
	   			'sitios_parqueadero_id' => 'required|min:1|max:99999999',
	   			'user_id' => 'required|min:1|max:99999999',
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$SitiosParqueaderoUsuario = SitiosParqueaderoUsuarioModel::all();

		$sitios_parqueadero_id = SitiosParqueaderoUsuarioModel::select("id","id as nombre")->get();
		   	$user_id = SitiosParqueaderoUsuarioModel::select("id","id as nombre")->get();
		   	
		return view('SitiosParqueaderoUsuario.index', [ "sitios_parqueadero_id" => $sitios_parqueadero_id,"user_id" => $user_id, 'listmysql' => $SitiosParqueaderoUsuario] );

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
			$SitiosParqueaderoUsuario = new SitiosParqueaderoUsuarioModel();
			
			 $SitiosParqueaderoUsuario->sitios_parqueadero_id=$request->sitios_parqueadero_id;
				 $SitiosParqueaderoUsuario->user_id=$request->user_id;
				 $SitiosParqueaderoUsuario->created_at=$request->created_at;
				 $SitiosParqueaderoUsuario->updated_at=$request->updated_at;
				
			$SitiosParqueaderoUsuario->save();
			return response()->json($SitiosParqueaderoUsuario);
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
		$SitiosParqueaderoUsuario = SitiosParqueaderoUsuarioModel::findOrFail($id);

		return view('SitiosParqueaderoUsuario.show', ['SitiosParqueaderoUsuarioModel' => $SitiosParqueaderoUsuario]);
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
			$SitiosParqueaderoUsuario = SitiosParqueaderoUsuarioModel::findOrFail($id);
			
			 $SitiosParqueaderoUsuario->sitios_parqueadero_id=$request->sitios_parqueadero_id;
				 $SitiosParqueaderoUsuario->user_id=$request->user_id;
				 $SitiosParqueaderoUsuario->created_at=$request->created_at;
				 $SitiosParqueaderoUsuario->updated_at=$request->updated_at;
				
		  
			$SitiosParqueaderoUsuario->save();
			return response()->json($SitiosParqueaderoUsuario);
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
		$SitiosParqueaderoUsuario = SitiosParqueaderoUsuarioModel::findOrFail($id);
		$SitiosParqueaderoUsuario->delete();
		return response()->json($SitiosParqueaderoUsuario);
	}


	/**
	* Change resource status. SitiosParqueaderoUsuarioModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$SitiosParqueaderoUsuario = SitiosParqueaderoUsuarioModel::findOrFail($id);
		$SitiosParqueaderoUsuario->is_published = !$SitiosParqueaderoUsuarioModel->is_published;
		$SitiosParqueaderoUsuario->save();

		return response()->json($SitiosParqueaderoUsuario);
	}
}


