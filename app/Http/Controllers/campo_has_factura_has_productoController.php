<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\campo_has_factura_has_productoModel;
use View;
use App\HasRoles;
use App\Roles;
use App\User;
use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class campo_has_factura_has_productoController extends Controller {
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
    'id' => 'required|min:1|max:99999999',
	   			'id' => 'required|min:2|max:255',
          'campo_id' => 'required|min:1|max:99999999',
	   			'campo_id' => 'required|min:2|max:255',
          'factura_has_producto_id' => 'required|min:1|max:99999999',
	   			'factura_has_producto_id' => 'required|min:2|max:255',
          'nombre' => 'required|min:2|max:255',
	   			'operacion' => 'required|min:2|max:255',
	   			'valor' => 'required|min:2|max:255',
	   			'orden' => 'required|min:2|max:255',
	   			
    //regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/
    
	];

	public function index(){
		return view('campo_has_factura_has_producto.index', [] );
  }
  public function consulta(Request $request){
    $consulta_data=$request->get("consulta_data");
    if($consulta_data==""){
      $data=campo_has_factura_has_productoModel::paginate(20);
    }else{
      $data=campo_has_factura_has_productoModel::where("id",1)
      ->orwhere("id","like","%". $consulta_data."%")
        ->orwhere("campo_id","like","%". $consulta_data."%")
        ->orwhere("factura_has_producto_id","like","%". $consulta_data."%")
        ->orwhere("nombre","like","%". $consulta_data."%")
        ->orwhere("operacion","like","%". $consulta_data."%")
        ->orwhere("valor","like","%". $consulta_data."%")
        ->orwhere("orden","like","%". $consulta_data."%")
        
      ->paginate(20);
    } 
    
    return response()->json($data);
  }
	public function create(){
    $data_foraneos = [
      "campo_id" => campo_has_factura_has_productoModel::select("id","id as nombre","id as text")->get(),
        "factura_has_producto_id" => campo_has_factura_has_productoModel::select("id","id as nombre","id as text")->get(),
        
      //"departamento_id" => DepartamentoModel::select("id_departamento as id","departamento as text")->get(),
		];
		return response()->json($data_foraneos);

  }

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
     
      /*
      $file2 = Input::file('archivo');
			if (isset($file2)) {
				$codigo=str_random(5);
				$nombre_original=$file2->getClientOriginalName();
				$nombres = $nombre_original.$codigo. '.' . $file2->getClientOriginalExtension();
        \Storage::disk('intervenir')->put($nombres, \File::get($file2));
      }
      */
      
      $campo_has_factura_has_producto = new campo_has_factura_has_productoModel();
			
			 $campo_has_factura_has_producto->campo_id=$request->campo_id;
				 $campo_has_factura_has_producto->factura_has_producto_id=$request->factura_has_producto_id;
				 $campo_has_factura_has_producto->nombre=$request->nombre;
				 $campo_has_factura_has_producto->operacion=$request->operacion;
				 $campo_has_factura_has_producto->valor=$request->valor;
				 $campo_has_factura_has_producto->orden=$request->orden;
				
			$campo_has_factura_has_producto->save();
			return response()->json($campo_has_factura_has_producto);
		}
	}
  public function show($id){
        return response()->json(campo_has_factura_has_productoModel::findOrFail($id));
    }
  

  public function edit($id){}

    public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$campo_has_factura_has_producto = campo_has_factura_has_productoModel::findOrFail($id);
			
			 $campo_has_factura_has_producto->campo_id=$request->campo_id;
				 $campo_has_factura_has_producto->factura_has_producto_id=$request->factura_has_producto_id;
				 $campo_has_factura_has_producto->nombre=$request->nombre;
				 $campo_has_factura_has_producto->operacion=$request->operacion;
				 $campo_has_factura_has_producto->valor=$request->valor;
				 $campo_has_factura_has_producto->orden=$request->orden;
				
		  
			$campo_has_factura_has_producto->save();
			return response()->json($campo_has_factura_has_producto);
		}
	}

	public function destroy($id){
		$campo_has_factura_has_producto = campo_has_factura_has_productoModel::findOrFail($id);
		$campo_has_factura_has_producto->delete();
		return response()->json($campo_has_factura_has_producto);
	}

}


