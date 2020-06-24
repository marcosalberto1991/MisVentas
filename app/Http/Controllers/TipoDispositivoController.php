<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\TipoDispositivoModel;
use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class TipoDispositivoController extends Controller
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
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		$TipoDispositivo = TipoDispositivoModel::all();
		return view('TipoDispositivo.index', [  'listmysql' => $TipoDispositivo] );

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
			$TipoDispositivo = new TipoDispositivoModel();
			
			$TipoDispositivo->nombre=$request->nombre;
			//$TipoDispositivo->created_at=$request->created_at;
			//$TipoDispositivo->updated_at=$request->updated_at;
				
			$TipoDispositivo->save();
			return response()->json($TipoDispositivo);
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
		$TipoDispositivo = TipoDispositivoModel::findOrFail($id);

		return view('TipoDispositivo.show', ['TipoDispositivoModel' => $TipoDispositivo]);
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
			$TipoDispositivo = TipoDispositivoModel::findOrFail($id);
			
			$TipoDispositivo->nombre=$request->nombre;
			//$TipoDispositivo->created_at=$request->created_at;
			//$TipoDispositivo->updated_at=$request->updated_at;	
		  
			$TipoDispositivo->save();
			return response()->json($TipoDispositivo);
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
		$TipoDispositivo = TipoDispositivoModel::findOrFail($id);
		$TipoDispositivo->delete();
		return response()->json($TipoDispositivo);
	}
	/**
	* Change resource status. TipoDispositivoModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$TipoDispositivo = TipoDispositivoModel::findOrFail($id);
		$TipoDispositivo->is_published = !$TipoDispositivoModel->is_published;
		$TipoDispositivo->save();

		return response()->json($TipoDispositivo);
	}
}


