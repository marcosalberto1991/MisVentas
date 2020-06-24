<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\ProveedorModel;
use View;

use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class ProveedorController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
		
				//'id' => 'required|min:1|max:99999999',
	   			'nombre' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'descricion' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			
	];

	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$Proveedor = ProveedorModel::all();

		
		return view('Proveedor.index', [  'listmysql' => $Proveedor] );

	}

	public function create(){}

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Proveedor = new ProveedorModel();
			
			 $Proveedor->nombre=$request->nombre;
				 $Proveedor->descricion=$request->descricion;
				 $Proveedor->created_at=$request->created_at;
				 $Proveedor->updated_at=$request->updated_at;
				
			$Proveedor->save();
			return response()->json($Proveedor);
		}
	}

	public function show($id){}

	public function edit($id){}

	public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Proveedor = ProveedorModel::findOrFail($id);
			
			 $Proveedor->nombre=$request->nombre;
				 $Proveedor->descricion=$request->descricion;
				 $Proveedor->created_at=$request->created_at;
				 $Proveedor->updated_at=$request->updated_at;
				
		  
			$Proveedor->save();
			return response()->json($Proveedor);
		}
	}

	public function destroy($id){
		$Proveedor = ProveedorModel::findOrFail($id);
		$Proveedor->delete();
		return response()->json($Proveedor);
	}

}


