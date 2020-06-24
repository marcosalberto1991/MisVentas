<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\prueba_ventaModel;
use View;
use App\HasRoles;
use App\Roles;
use App\User;
use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class prueba_ventaController extends Controller {
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
    'id' => 'required|min:1|max:99999999',
	   			'id' => 'required|min:2|max:255',
          'fecha_venta' => 'required|min:2|max:255',
	   			'users_id' => 'required|min:1|max:99999999',
	   			'users_id' => 'required|min:2|max:255',
          'estado_venta_id' => 'required|min:1|max:99999999',
	   			'estado_venta_id' => 'required|min:2|max:255',
          'created_at' => 'required|min:2|max:255',
          'updated_at' => 'required|min:2|max:255',
          
    //regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/
    
	];

	public function index(){
		return view('prueba_venta.index', [] );
  }
  public function consulta(Request $request){
    $consulta_data=$request->get("consulta_data");
    if($consulta_data==""){
      $data=prueba_ventaModel::paginate(20);
    }else{
      $data=prueba_ventaModel::where("id",1)
      ->orwhere("id","like","%". $consulta_data."%")
        ->orwhere("fecha_venta","like","%". $consulta_data."%")
        ->orwhere("users_id","like","%". $consulta_data."%")
        ->orwhere("estado_venta_id","like","%". $consulta_data."%")
        ->orwhere("created_at","like","%". $consulta_data."%")
        ->orwhere("updated_at","like","%". $consulta_data."%")
        
      ->paginate(20);
    } 
    
    return response()->json($data);
  }
	public function create(){
    $data_foraneos = [
      "users_id" => prueba_ventaModel::select("id","id as nombre","id as text")->get(),
        "estado_venta_id" => prueba_ventaModel::select("id","id as nombre","id as text")->get(),
        
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
      
      $prueba_venta = new prueba_ventaModel();
			
			 $prueba_venta->fecha_venta=$request->fecha_venta;
				 $prueba_venta->users_id=$request->users_id;
				 $prueba_venta->estado_venta_id=$request->estado_venta_id;
				 $prueba_venta->created_at=$request->created_at;
				 $prueba_venta->updated_at=$request->updated_at;
				
			$prueba_venta->save();
			return response()->json($prueba_venta);
		}
	}
  public function show($id){
        return response()->json(prueba_ventaModel::findOrFail($id));
    }
  

  public function edit($id){}

    public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$prueba_venta = prueba_ventaModel::findOrFail($id);
			
			 $prueba_venta->fecha_venta=$request->fecha_venta;
				 $prueba_venta->users_id=$request->users_id;
				 $prueba_venta->estado_venta_id=$request->estado_venta_id;
				 $prueba_venta->created_at=$request->created_at;
				 $prueba_venta->updated_at=$request->updated_at;
				
		  
			$prueba_venta->save();
			return response()->json($prueba_venta);
		}
	}

	public function destroy($id){
		$prueba_venta = prueba_ventaModel::findOrFail($id);
		$prueba_venta->delete();
		return response()->json($prueba_venta);
	}

}


