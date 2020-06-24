<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\ProductosModel;
use View;

use App\HasRoles;

use App\EstadoModel;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class ProductosController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
		
				//'id' => 'required|min:1|max:99999999',
	   			'codigo_producto' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'nombre' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'estados_id' => 'required|min:1|max:99999999',
	   			'precio_venta' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'descricion' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			
	];

	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$Productos = ProductosModel::all();

		$estados_id = EstadoModel::select("id","nombre")->get();
		   	
		return view('Productos.index', [ "estados_id" => $estados_id, 'listmysql' => $Productos] );

	}

	public function create(){}

	public function store(Request $request){  
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Productos = new ProductosModel();
			
			 $Productos->codigo_producto=$request->codigo_producto;
				 $Productos->nombre=$request->nombre;
				 $Productos->descricion=$request->descricion;
				 $file2 = Input::file('imagen');
				if(isset($file2)) {
					$nombres = time() . str_random(5) . '.' . $file2->getClientOriginalExtension();
					\Storage::disk('perfil')->put($nombres, \File::get($file2));
					$Productos->imagen = $nombres;
				}
				 $Productos->estados_id=$request->estados_id;
				 $Productos->precio_venta=$request->precio_venta;
				
			$Productos->save();
			return response()->json($Productos);
		}
	}

	public function show($id){}

	public function edit($id){}

	public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Productos = ProductosModel::findOrFail($id);
			
			 $Productos->codigo_producto=$request->codigo_producto;
				 $Productos->nombre=$request->nombre;
				 $Productos->descricion=$request->descricion;
				 $file2 = Input::file('imagen');
				if(isset($file2)) {
					$nombres = time() . str_random(5) . '.' . $file2->getClientOriginalExtension();
					\Storage::disk('perfil')->put($nombres, \File::get($file2));
					$Productos->imagen = $nombres;
				}
				 $Productos->estados_id=$request->estados_id;
				 $Productos->precio_venta=$request->precio_venta;
				
		  
			$Productos->save();
			return response()->json($Productos);
		}
	}

	public function destroy($id){
		$Productos = ProductosModel::findOrFail($id);
		$Productos->delete();
		return response()->json($Productos);
	}

}


