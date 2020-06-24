<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\SitiosParqueaderoModel;
use App\SitiosParqueaderoUsuarioModel;

use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class SitiosParqueaderoController extends Controller
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
	   			'direccion' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$Sitios_Usuario=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->select('sitios_parqueadero_id')->get()->toArray();
		//var_dump($Sitios_Usuario);exit();
		$SitiosParqueadero = SitiosParqueaderoModel::wherein('id',[$Sitios_Usuario])->get();

		
		return view('SitiosParqueadero.index', [  'listmysql' => $SitiosParqueadero] );

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
			$SitiosParqueadero = new SitiosParqueaderoModel();
			
			 $SitiosParqueadero->nombre=$request->nombre;
				 $SitiosParqueadero->direccion=$request->direccion;
				 //$SitiosParqueadero->created_at=$request->created_at;
				 //$SitiosParqueadero->updated_at=$request->updated_at;
				
			$SitiosParqueadero->save();
			return response()->json($SitiosParqueadero);
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
		$SitiosParqueadero = SitiosParqueaderoModel::findOrFail($id);

		return view('SitiosParqueadero.show', ['SitiosParqueaderoModel' => $SitiosParqueadero]);
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
			$SitiosParqueadero = SitiosParqueaderoModel::findOrFail($id);
			
			 $SitiosParqueadero->nombre=$request->nombre;
				 $SitiosParqueadero->direccion=$request->direccion;
				 //$SitiosParqueadero->created_at=$request->created_at;
				 //$SitiosParqueadero->updated_at=$request->updated_at;
				
		  
			$SitiosParqueadero->save();
			return response()->json($SitiosParqueadero);
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
		$SitiosParqueadero = SitiosParqueaderoModel::findOrFail($id);
		$SitiosParqueadero->delete();
		return response()->json($SitiosParqueadero);
	}


	/**
	* Change resource status. SitiosParqueaderoModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$SitiosParqueadero = SitiosParqueaderoModel::findOrFail($id);
		$SitiosParqueadero->is_published = !$SitiosParqueaderoModel->is_published;
		$SitiosParqueadero->save();

		return response()->json($SitiosParqueadero);
	}
}


