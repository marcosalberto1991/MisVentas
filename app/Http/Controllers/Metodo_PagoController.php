<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\Metodo_PagoModel;
use View;
use App\HasRoles;
use App\Roles;
use App\User;
use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class Metodo_PagoController extends Controller {
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
    'id' => 'required|min:1|max:99999999',
	   			'id' => 'required|min:2|max:255',
          'nombre' => 'required|min:2|max:255',
	   			'icono' => 'required|min:2|max:255',
	   			'color' => 'required|min:2|max:255',
	   			
    //regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/
    
	];

	public function index(){
		return view('Metodo_Pago.index', [] );
  }
  public function consulta(Request $request){
    $consulta_data=$request->get("consulta_data");
    if($consulta_data==""){
      $data=Metodo_PagoModel::paginate(20);
    }else{
      $data=Metodo_PagoModel::where("id",1)
      ->orwhere("id","like","%". $consulta_data."%")
        ->orwhere("nombre","like","%". $consulta_data."%")
        ->orwhere("icono","like","%". $consulta_data."%")
        ->orwhere("color","like","%". $consulta_data."%")
        
      ->paginate(20);
    } 
    
    return response()->json($data);
  }
	public function create(){
    $data_foraneos = [
      
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
      
      $Metodo_Pago = new Metodo_PagoModel();
			
			 $Metodo_Pago->nombre=$request->nombre;
				 $Metodo_Pago->icono=$request->icono;
				 $Metodo_Pago->color=$request->color;
				
			$Metodo_Pago->save();
			return response()->json($Metodo_Pago);
		}
	}
  public function show($id){
        return response()->json(Metodo_PagoModel::findOrFail($id));
    }
  

  public function edit($id){}

    public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Metodo_Pago = Metodo_PagoModel::findOrFail($id);
			
			 $Metodo_Pago->nombre=$request->nombre;
				 $Metodo_Pago->icono=$request->icono;
				 $Metodo_Pago->color=$request->color;
				
		  
			$Metodo_Pago->save();
			return response()->json($Metodo_Pago);
		}
	}

	public function destroy($id){
		$Metodo_Pago = Metodo_PagoModel::findOrFail($id);
		$Metodo_Pago->delete();
		return response()->json($Metodo_Pago);
	}

}


