<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\venta_pruebaModel;
use View;
use App\HasRoles;
use App\Roles;
use App\User;
use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class venta_pruebaController extends Controller {
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
		return view('venta_prueba.index', [] );
  }
  public function consulta(Request $request){
    $consulta_data=$request->get("consulta_data");
    if($consulta_data==""){
      $data=venta_pruebaModel::paginate(20);
    }else{
      $data=venta_pruebaModel::where("id",1)
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
      "users_id" => venta_pruebaModel::select("id","id as nombre","id as text")->get(),
        "estado_venta_id" => venta_pruebaModel::select("id","id as nombre","id as text")->get(),
        
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
      
      $venta_prueba = new venta_pruebaModel();
			
			 $venta_prueba->fecha_venta=$request->fecha_venta;
				 $venta_prueba->users_id=$request->users_id;
				 $venta_prueba->estado_venta_id=$request->estado_venta_id;
				 $venta_prueba->created_at=$request->created_at;
				 $venta_prueba->updated_at=$request->updated_at;
				
			$venta_prueba->save();
			return response()->json($venta_prueba);
		}
	}
  public function show($id){
        return response()->json(venta_pruebaModel::findOrFail($id));
    }
  

  public function edit($id){}

    public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$venta_prueba = venta_pruebaModel::findOrFail($id);
			
			 $venta_prueba->fecha_venta=$request->fecha_venta;
				 $venta_prueba->users_id=$request->users_id;
				 $venta_prueba->estado_venta_id=$request->estado_venta_id;
				 $venta_prueba->created_at=$request->created_at;
				 $venta_prueba->updated_at=$request->updated_at;
				
		  
			$venta_prueba->save();
			return response()->json($venta_prueba);
		}
	}

	public function destroy($id){
		$venta_prueba = venta_pruebaModel::findOrFail($id);
		$venta_prueba->delete();
		return response()->json($venta_prueba);
	}

}


