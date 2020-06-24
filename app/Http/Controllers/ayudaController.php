<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\ayudaModel;
use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Highlight\Highlighter;
use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class ayudaController extends Controller
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
	   			'nombre' => 'required|min:1|max:99999999',
	   			'descricion' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$ayuda = ayudaModel::all();

		
		return view('ayuda.index', [  'listmysql' => $ayuda] );

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
			$ayuda = new ayudaModel();
			
			 $ayuda->nombre=$request->nombre;
				 $ayuda->descricion=$request->descricion;
				 $ayuda->fuente_codigo=$request->fuente_codigo;
				 $ayuda->created_at=$request->created_at;
				 $ayuda->updated_at=$request->updated_at;
				
			$ayuda->save();
			return response()->json($ayuda);
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
		$ayuda = ayudaModel::findOrFail($id);

		return view('ayuda.show', ['ayudaModel' => $ayuda]);
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
			$ayuda = ayudaModel::findOrFail($id);
			
			 $ayuda->nombre=$request->nombre;
				 $ayuda->descricion=$request->descricion;
				 $ayuda->fuente_codigo=$request->fuente_codigo;
				 $ayuda->created_at=$request->created_at;
				 $ayuda->updated_at=$request->updated_at;
				
		  
			$ayuda->save();
			return response()->json($ayuda);
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
		$ayuda = ayudaModel::findOrFail($id);
		$ayuda->delete();
		return response()->json($ayuda);
	}


	/**
	* Change resource status. ayudaModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$ayuda = ayudaModel::findOrFail($id);
		$ayuda->is_published = !$ayudaModel->is_published;
		$ayuda->save();

		return response()->json($ayuda);
	}
}


