<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\Productos_has_ventaModel;
use View;

use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class Productos_has_ventaController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
	   			'productos_id' => 'required|min:1|max:99999999',
	   			'venta_id' => 'required|min:1|max:99999999',
	   			'cantidad' => 'required|min:1|max:99999999',
	   			'precio_producto' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'estado_venta_id' => 'required|min:1|max:99999999',
	   			
	];

	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		$Productos_has_venta = Productos_has_ventaModel::all();

		$productos_id = Productos_has_ventaModel::select("id","id as nombre")->get();
		   	$venta_id = Productos_has_ventaModel::select("id","id as nombre")->get();
		   	$estado_venta_id = Productos_has_ventaModel::select("id","id as nombre")->get();
		   	
		return view('Productos_has_venta.index', [ "productos_id" => $productos_id,"venta_id" => $venta_id,"estado_venta_id" => $estado_venta_id, 'listmysql' => $Productos_has_venta] );

	}

	public function create(){}

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Productos_has_venta = new Productos_has_ventaModel();
			
			 $Productos_has_venta->productos_id=$request->productos_id;
				 $Productos_has_venta->venta_id=$request->venta_id;
				 $Productos_has_venta->cantidad=$request->cantidad;
				 $Productos_has_venta->precio_producto=$request->precio_producto;
				 $Productos_has_venta->estado_venta_id=$request->estado_venta_id;
				 $Productos_has_venta->updated_at=$request->updated_at;
				 $Productos_has_venta->created_at=$request->created_at;
				
			$Productos_has_venta->save();
			return response()->json($Productos_has_venta);
		}
	}

	public function show($id){}

	public function edit($id){}

	public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Productos_has_venta = Productos_has_ventaModel::findOrFail($id);
			
			 $Productos_has_venta->productos_id=$request->productos_id;
				 $Productos_has_venta->venta_id=$request->venta_id;
				 $Productos_has_venta->cantidad=$request->cantidad;
				 $Productos_has_venta->precio_producto=$request->precio_producto;
				 $Productos_has_venta->estado_venta_id=$request->estado_venta_id;
				 $Productos_has_venta->updated_at=$request->updated_at;
				 $Productos_has_venta->created_at=$request->created_at;
				
		  
			$Productos_has_venta->save();
			return response()->json($Productos_has_venta);
		}
	}

	public function destroy($id){
		$Productos_has_venta = Productos_has_ventaModel::findOrFail($id);
		$Productos_has_venta->delete();
		return response()->json($Productos_has_venta);
	}

}


