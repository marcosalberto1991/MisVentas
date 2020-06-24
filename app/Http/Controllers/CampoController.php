<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\CampoModel;
use View;
use App\HasRoles;
use App\Roles;
use App\User;
use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class CampoController extends Controller {
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
    'id' => 'required|min:1|max:99999999',
	   			'id' => 'required|min:2|max:255',
          'nombre' => 'required|min:2|max:255',
	   			'orden' => 'required|min:2|max:255',
	   			'operacion' => 'required|min:2|max:255',
	   			'proveedor_id' => 'required|min:1|max:99999999',
	   			'proveedor_id' => 'required|min:2|max:255',
          
    //regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/
    
	];

	public function index(){
		return view('Campo.index', [] );
  }
  public function consulta(Request $request){
    $consulta_data=$request->get("consulta_data");
    if($consulta_data==""){
      $data=CampoModel::paginate(20);
    }else{
      $data=CampoModel::where("id",1)
      ->orwhere("id","like","%". $consulta_data."%")
        ->orwhere("nombre","like","%". $consulta_data."%")
        ->orwhere("orden","like","%". $consulta_data."%")
        ->orwhere("operacion","like","%". $consulta_data."%")
        ->orwhere("proveedor_id","like","%". $consulta_data."%")
        
      ->paginate(20);
    } 
    
    return response()->json($data);
  }
	public function create(){
    $data_foraneos = [
      "proveedor_id" => CampoModel::select("id","id as nombre","id as text")->get(),
        
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
      
      $Campo = new CampoModel();
			
			 $Campo->nombre=$request->nombre;
				 $Campo->orden=$request->orden;
				 $Campo->operacion=$request->operacion;
				 $Campo->proveedor_id=$request->proveedor_id;
				
			$Campo->save();
			return response()->json($Campo);
		}
	}
  public function show($id){
        return response()->json(CampoModel::findOrFail($id));
    }
  

  public function edit($id){}

    public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Campo = CampoModel::findOrFail($id);
			
			 $Campo->nombre=$request->nombre;
				 $Campo->orden=$request->orden;
				 $Campo->operacion=$request->operacion;
				 $Campo->proveedor_id=$request->proveedor_id;
				
		  
			$Campo->save();
			return response()->json($Campo);
		}
	}

	public function destroy($id){
		$Campo = CampoModel::findOrFail($id);
		$Campo->delete();
		return response()->json($Campo);
	}

}


