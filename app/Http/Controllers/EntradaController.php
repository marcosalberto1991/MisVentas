<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\EntradaModel;
use View;
use App\ProductosModel;
use App\FacturaModel;
use App\EstadoModel;
use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class EntradaController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =[
		//'id' => 'required|min:1|max:99999999',
		'cantidad' => 'required|min:1|max:99999999',
		//'existencia' => 'required|min:1|max:99999999',
		'precio_unidad' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
		'productos_id' => 'required|min:1|max:99999999',
		//'users_id' => 'required|min:1|max:99999999',
		'lote' => 'required|min:1|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
		'numero_lote' => 'required|min:1|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
		'factura_id' => 'required|min:1|max:99999999',
		'estado_id' => 'min:1|max:99999999',
		'fecha_vencimiento' =>  'required'  
	];

	public function index(){

		$Entrada = EntradaModel::all();

		$productos_id = EntradaModel::select("id","id as nombre")->get();
		$users_id = EntradaModel::select("id","id as nombre")->get();
		$factura_id = EntradaModel::select("id","id as nombre")->get();
		$estado_id = EntradaModel::select("id","id as nombre")->get();
		   	
		return view('Entrada.index', [ "productos_id" => $productos_id,"users_id" => $users_id,"factura_id" => $factura_id,"estado_id" => $estado_id, 'listmysql' => $Entrada] );

	}

	public function create(){}

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Entrada = new EntradaModel();
			
			$Entrada->cantidad=$request->cantidad;
			$Entrada->existencia=$request->existencia;
			$Entrada->precio_unidad=$request->precio_unidad;
			$Entrada->productos_id=$request->productos_id;
			$Entrada->users_id=auth()->user()->id;
			$Entrada->lote=$request->lote;
			$Entrada->numero_lote=$request->numero_lote;
			$Entrada->factura_id=$request->factura_id;
			$Entrada->fecha_vencimiento=$request->fecha_vencimiento;
			
			$Entrada->estado_id=1;
				
			$Entrada->save();
			return response()->json($Entrada);
		}
	}

	public function entrada($factura_id){
		$Entrada = EntradaModel::where('factura_id',$factura_id)->get();
		$productos_id = ProductosModel::select("id","nombre")->get();
		$users_id = user::select("id","name as nombre")->get();
		$factura_id = FacturaModel::where('id',$factura_id)->first();
		$estado_id = EstadoModel::select("id","nombre")->get();
		   	
		return view('Entrada.entrada', [ "productos_id" => $productos_id,"users_id" => $users_id,"factura_id" => $factura_id,"estado_id" => $estado_id, 'listmysql' => $Entrada] );

	}
	public function show($id){}

	public function edit($id){}

	public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Entrada = EntradaModel::findOrFail($id);
			
			$Entrada->cantidad=$request->cantidad;
			//$Entrada->existencia=$request->existencia;
			$Entrada->precio_unidad=$request->precio_unidad;
			$Entrada->productos_id=$request->productos_id;
			//$Entrada->users_id=$request->users_id;
			$Entrada->lote=$request->lote;
			$Entrada->numero_lote=$request->numero_lote;
			//$Entrada->factura_id=$request->factura_id;
			$Entrada->fecha_vencimiento=$request->fecha_vencimiento;

			$Entrada->estado_id;
				
			$Entrada->save();
			$Entrada->estado_id_pk=1;
			return response()->json($Entrada);
		}
	}

	public function destroy($id){
		$Entrada = EntradaModel::findOrFail($id);
		$Entrada->delete();
		return response()->json($Entrada);
	}

}


