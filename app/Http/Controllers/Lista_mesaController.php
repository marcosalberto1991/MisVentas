<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\ProductoModel;
use App\Lista_mesaModel;
use App\Ventas_has_productoModel;
use App\VentasModel;

use View;

use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class Lista_mesaController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
		
				'id' => 'required|min:1|max:99999999',
	   			'nombre' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'posicion_x' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'posixion_y' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			
	];

	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();
		//$ventas=Ventas_has_productoModel::with('ventas_id_pk.mesa_id_pk')->get();
		$ventas=VentasModel::with('ventas_has_producto_all.producto_id_pk','mesa_id_pk')->get();
		
		//print_r ($ventas);exit();
		$producto = ProductoModel::all();
		$Lista_mesa = Lista_mesaModel::all();

		
		return view('Lista_mesa.index', [  
			'listmysql' => $Lista_mesa,
			'ventas' => $ventas,
			'producto' => $producto
			
			] );

	}

	public function create(){}

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Lista_mesa = new Lista_mesaModel();
			
			 $Lista_mesa->nombre=$request->nombre;
				 $Lista_mesa->posicion_x=$request->posicion_x;
				 $Lista_mesa->posixion_y=$request->posixion_y;
				 $Lista_mesa->created_at=$request->created_at;
				 $Lista_mesa->updated_at=$request->updated_at;
				
			$Lista_mesa->save();
			return response()->json($Lista_mesa);
		}
	}

	public function show(Request $request){
		$producto=ProductoModel::select('nombre','id')->get();
		return response()->json($producto);
	}

	public function edit($id){}

	public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Lista_mesa = Lista_mesaModel::findOrFail($id);
			
			 $Lista_mesa->nombre=$request->nombre;
				 $Lista_mesa->posicion_x=$request->posicion_x;
				 $Lista_mesa->posixion_y=$request->posixion_y;
				 $Lista_mesa->created_at=$request->created_at;
				 $Lista_mesa->updated_at=$request->updated_at;
				
		  
			$Lista_mesa->save();
			return response()->json($Lista_mesa);
		}
	}

	public function destroy($id){
		$Lista_mesa = Lista_mesaModel::findOrFail($id);
		$Lista_mesa->delete();
		return response()->json($Lista_mesa);
	}
	

}


