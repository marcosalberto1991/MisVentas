<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\ProductoModel;
use View;

use App\HasRoles;
use App\Roles;
use App\User;
use App\ProveedorModel;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class ProductoController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
		
				//'id' => 'required|min:1|max:99999999',
	   			'nombre_proveedor' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'nombre' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'imagen' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'precio_caja' => 'required|min:1|max:99999999',
	   			'cantidad_caja' => 'required|min:1|max:99999999',
	   			'precio_unidad' => 'required|min:1|max:99999999',
	   			'iva' => 'required|min:1|max:99999999',
	   			'porcentaje_ganacia' => 'required|min:1|max:99999999',
	   			'precio_venta' => 'required|min:1|max:99999999',
	   			'ganacia' => 'required|min:1|max:99999999',
	   			'proveedor_id' => 'required|min:1|max:99999999',
	   			
	];

	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$Producto = ProductoModel::all();

		$proveedor_id = ProveedorModel::select("id","nombre")->get();
		   	
		return view('Producto.index', [ "proveedor_id" => $proveedor_id, 'listmysql' => $Producto] );

	}

	public function create(){}

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Producto = new ProductoModel();
			
			$Producto->nombre_proveedor=$request->nombre_proveedor;
			$Producto->nombre=$request->nombre;
			$Producto->imagen=$request->imagen;
			$Producto->precio_caja=$request->precio_caja;
			$Producto->cantidad_caja=$request->cantidad_caja;
			$Producto->precio_unidad=$request->precio_unidad;
			$Producto->iva=$request->iva;
			$Producto->porcentaje_ganacia=$request->porcentaje_ganacia;
			$Producto->precio_venta=$request->precio_venta;
			$Producto->ganacia=$request->ganacia;
			$Producto->proveedor_id=$request->proveedor_id;
				
			$Producto->save();
			return response()->json($Producto);
		}
	}

	public function show($id){}

	public function edit($id){}

	public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Producto = ProductoModel::findOrFail($id);
			$file2 = Input::file('imagen');
	        if(isset($file2)) {
	            $nombres = time() . str_random(5) . '.' . $file2->getClientOriginalExtension();
	            \Storage::disk('perfil')->put($nombres, \File::get($file2));
	            $Producto->imagen = $nombres;
	        }
			$Producto->nombre_proveedor=$request->nombre_proveedor;
			$Producto->nombre=$request->nombre;
			//$Producto->imagen=$request->imagen;
			$Producto->precio_caja=$request->precio_caja;
			$Producto->cantidad_caja=$request->cantidad_caja;
			$Producto->precio_unidad=$request->precio_unidad;
			$Producto->iva=$request->iva;
			$Producto->porcentaje_ganacia=$request->porcentaje_ganacia;
			$Producto->precio_venta=$request->precio_venta;
			$Producto->ganacia=$request->ganacia;
			$Producto->proveedor_id=$request->proveedor_id;
			$Producto->save();
			
			return response()->json($Producto);
		}
	}
	public function destroy($id){
		$Producto = ProductoModel::findOrFail($id);
		$Producto->delete();
		return response()->json($Producto);
	}

}


