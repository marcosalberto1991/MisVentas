<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\CategoriaParqueaderoModel;
use App\SitiosParqueaderoUsuarioModel;
use App\ZonaParqueaderoModel;
use App\NivelesModel;
use App\EstadoModel;






use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class CategoriaParqueaderoController extends Controller
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
	   			'letra' => 'required|min:1|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'zona_parqueadero_id' => 'required|min:1|max:99999999',
	   			'niveles_id' => 'required|min:1|max:99999999',
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



		$CategoriaParqueadero = CategoriaParqueaderoModel::wherein('zona_parqueadero_id',$zona_parqueadero_id)->get();

		$zona_parqueadero_id = ZonaParqueaderoModel::select("id","nombre")->wherein('id',$zona_parqueadero_id)->get();
		$niveles_id = NivelesModel::select("id","nombre")->wherein('zona_parqueadero_id',$zona_parqueadero_id)->get();
		$estado_id = EstadoModel::select("id","nombre")->get();
		   	
		return view('CategoriaParqueadero.index', [ "zona_parqueadero_id" => $zona_parqueadero_id,"niveles_id" => $niveles_id,"estado_id" => $estado_id, 'listmysql' => $CategoriaParqueadero] );

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
			
			$Sitios_Usuario=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->select('sitios_parqueadero_id')->get()->toArray();
			$zona_parqueadero_id = ZonaParqueaderoModel::wherein('id',[$Sitios_Usuario])->select('id')->get();

			$sitios_parqueadero_id=ZonaParqueaderoModel::where('id',$request->zona_parqueadero_id)->first();

			$CategoriaParqueadero = new CategoriaParqueaderoModel();
			
			$CategoriaParqueadero->letra=$request->letra;
			$CategoriaParqueadero->zona_parqueadero_id=$request->zona_parqueadero_id;
			$CategoriaParqueadero->niveles_id=$request->niveles_id;
			$CategoriaParqueadero->estado_id=$request->estado_id;
			$CategoriaParqueadero->zona_parqueadero_sitios_parqueadero_id = $sitios_parqueadero_id->sitios_parqueadero_id;
			//$CategoriaParqueadero->created_at=$request->created_at;
			//$CategoriaParqueadero->updated_at=$request->updated_at; 


				
			$CategoriaParqueadero->save();
			return response()->json($CategoriaParqueadero);
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
		$CategoriaParqueadero = CategoriaParqueaderoModel::findOrFail($id);

		return view('CategoriaParqueadero.show', ['CategoriaParqueaderoModel' => $CategoriaParqueadero]);
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
			$CategoriaParqueadero = CategoriaParqueaderoModel::findOrFail($id);
			
			$sitios_parqueadero_id=ZonaParqueaderoModel::where('id',$request->zona_parqueadero_id)->first();

			$CategoriaParqueadero->letra=$request->letra;
			$CategoriaParqueadero->zona_parqueadero_id=$request->zona_parqueadero_id;
			$CategoriaParqueadero->niveles_id=$request->niveles_id;
			$CategoriaParqueadero->estado_id=$request->estado_id;
			$CategoriaParqueadero->zona_parqueadero_sitios_parqueadero_id = $sitios_parqueadero_id->sitios_parqueadero_id;
			//$CategoriaParqueadero->created_at=$request->created_at;
			//$CategoriaParqueadero->updated_at=$request->updated_at;
				
		  
			$CategoriaParqueadero->save();
			return response()->json($CategoriaParqueadero);
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
		$CategoriaParqueadero = CategoriaParqueaderoModel::findOrFail($id);
		$CategoriaParqueadero->delete();
		return response()->json($CategoriaParqueadero);
	}


	/**
	* Change resource status. CategoriaParqueaderoModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$CategoriaParqueadero = CategoriaParqueaderoModel::findOrFail($id);
		$CategoriaParqueadero->is_published = !$CategoriaParqueaderoModel->is_published;
		$CategoriaParqueadero->save();

		return response()->json($CategoriaParqueadero);
	}
	public function niveles($zona_parqueadero_id){
		//$Sitios_Usuario=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->select('sitios_parqueadero_id')->get()->toArray();
		$zona_parqueadero_id = NivelesModel::where('zona_parqueadero_id',$zona_parqueadero_id)->select('id','nombre')->get();
		return response()->json($zona_parqueadero_id);
		
	}
}


