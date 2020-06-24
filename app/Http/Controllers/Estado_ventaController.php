<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\Estado_ventaModel;
use View;

use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class Estado_ventaController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
		
				'id' => 'required|min:1|max:99999999',
	   			'nombre' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			
	];

	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$Estado_venta = Estado_ventaModel::all();

		
		return view('Estado_venta.index', [  'listmysql' => $Estado_venta] );

	}

	public function create(){}

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Estado_venta = new Estado_ventaModel();
			
			 $Estado_venta->nombre=$request->nombre;
				 $Estado_venta->created_at=$request->created_at;
				 $Estado_venta->updated_at=$request->updated_at;
				
			$Estado_venta->save();
			return response()->json($Estado_venta);
		}
	}

	public function show($id){}

	public function edit($id){}

	public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Estado_venta = Estado_ventaModel::findOrFail($id);
			
			 $Estado_venta->nombre=$request->nombre;
				 $Estado_venta->created_at=$request->created_at;
				 $Estado_venta->updated_at=$request->updated_at;
				
		  
			$Estado_venta->save();
			return response()->json($Estado_venta);
		}
	}

	public function destroy($id){
		$Estado_venta = Estado_ventaModel::findOrFail($id);
		$Estado_venta->delete();
		return response()->json($Estado_venta);
	}

}


