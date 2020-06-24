<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\DispositivoModel;
use App\TipoDispositivoModel;


use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class DispositivoController extends Controller
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
		
				'nombre' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'latitud' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'logitud' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'descricion' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'tipo_dispositivo_id' => 'required|min:1|max:99999999',
	   			//'users_id' => 'required|min:1|max:99999999',
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$Dispositivo = DispositivoModel::all();

		$tipo_dispositivo_id = TipoDispositivoModel::select("id","nombre")->get();
		   	//$users_id = DispositivoModel::select("id","id as nombre")->get();
		   	
		return view('Dispositivo.index', [ "tipo_dispositivo_id" => $tipo_dispositivo_id, 'listmysql' => $Dispositivo] );

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
			$Dispositivo = new DispositivoModel();
			
			 $Dispositivo->nombre=$request->nombre;
				 $Dispositivo->latitud=$request->latitud;
				 $Dispositivo->logitud=$request->logitud;
				 $Dispositivo->descricion=$request->descricion;
				 $Dispositivo->tipo_dispositivo_id=$request->tipo_dispositivo_id;
				 $Dispositivo->users_id=auth()->user()->id;
				 //$Dispositivo->created_at=$request->created_at;
				 //$Dispositivo->updated_at=$request->updated_at;
				
			$Dispositivo->save();
			return response()->json($Dispositivo);
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
		$Dispositivo = DispositivoModel::findOrFail($id);

		return view('Dispositivo.show', ['DispositivoModel' => $Dispositivo]);
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
			$Dispositivo = DispositivoModel::findOrFail($id);
			
			$Dispositivo->nombre=$request->nombre;
			$Dispositivo->latitud=$request->latitud;
			$Dispositivo->logitud=$request->logitud;
			$Dispositivo->descricion=$request->descricion;
			$Dispositivo->tipo_dispositivo_id=$request->tipo_dispositivo_id;
			//$Dispositivo->users_id=auth()->user()->id;
			$Dispositivo->created_at=$request->created_at;
			$Dispositivo->updated_at=$request->updated_at;
				
		  
			$Dispositivo->save();
			return response()->json($Dispositivo);
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
		$Dispositivo = DispositivoModel::findOrFail($id);
		$Dispositivo->delete();
		return response()->json($Dispositivo);
	}
	/**
	* Change resource status. DispositivoModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$Dispositivo = DispositivoModel::findOrFail($id);
		$Dispositivo->is_published = !$DispositivoModel->is_published;
		$Dispositivo->save();

		return response()->json($Dispositivo);
	}
}


