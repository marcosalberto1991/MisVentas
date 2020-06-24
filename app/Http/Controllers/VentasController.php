<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\VentasModel;
use App\MesaModel;
use View;
use DB;
use App\EstadoModel;
use App\Productos_has_ventaModel;
use App\Roles;
use App\User;
use App\Ventas_has_productoModel;
use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class VentasController extends Controller {
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
		'id' => 'required|min:1|max:255',
		//'precio' => 'required|min:1|max:255',
		'mesa_id' => 'required|min:1|max:99999999',
		'mesa_id' => 'required|min:1|max:255',
		'lista_precio_id' => 'required|min:1|max:99999999',
		'lista_precio_id' => 'required|min:1|max:255',
		'estado_id' => 'required|min:1|max:99999999',
		'estado_id' => 'required|min:1|max:255',
		'updated_at' => 'required|min:1|max:255',
		'created_at' => 'required|min:1|max:255',
          
    //regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/
    
	];

	public function index(){
		return view('Ventas.index', [] );
  }
  public function consulta(Request $request){
    $consulta_data=$request->get("consulta_data");
    if($consulta_data==""){
	  $data = VentasModel::with('mesa_id','estado_id','ventas_has_producto_all_ventas.producto_id')
	  ->orderBy('id', 'DESC')
	  ->paginate(20)
	  //->toarray()
	  ;
	  

		foreach($data as $key => $datos){
			$datas = Ventas_has_productoModel::
			//select('cantidad*precio_producto as suma')->
			where('ventas_id',$datos['id'])
			//->select('cantidad * precio as esssss')
			->select(DB::raw("(cantidad * precio) as totalPriceQuantity"))
			->get()
			->sum('totalPriceQuantity')
			
			//->toarray()
			;
			//echo $datos['id'];
			//var_dump($datas);echo '<br>';
			//echo 
			$data[$key]['suma_total']=$datas;
		}	

	}else{
      $data=VentasModel::where("id",1)
      ->orwhere("id","like","%". $consulta_data."%")
        ->orwhere("precio","like","%". $consulta_data."%")
        ->orwhere("mesa_id","like","%". $consulta_data."%")
        ->orwhere("lista_precio_id","like","%". $consulta_data."%")
        ->orwhere("estado_id","like","%". $consulta_data."%")
        ->orwhere("updated_at","like","%". $consulta_data."%")
        ->orwhere("created_at","like","%". $consulta_data."%")
        
      ->paginate(20);
    } 
    
    return response()->json($data);
  }
	public function create(){
    $data_foraneos = [
      "mesa_id" => MesaModel::select("id","id as nombre","nombre as text")->get(),
        
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
      
      $Ventas = new VentasModel();
			
			 $Ventas->precio=$request->precio;
				 $Ventas->mesa_id=$request->mesa_id;
				 $Ventas->lista_precio_id=$request->lista_precio_id;
				 $Ventas->estado_id=$request->estado_id;
				 $Ventas->updated_at=$request->updated_at;
				 $Ventas->created_at=$request->created_at;
				
			$Ventas->save();
			return response()->json($Ventas);
		}
	}
  public function show($id){
        return response()->json(VentasModel::findOrFail($id));
    }
  

  public function edit($id){}

    public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Ventas = VentasModel::findOrFail($id);
			
			 $Ventas->precio=$request->precio;
				 $Ventas->mesa_id=$request->mesa_id;
				 $Ventas->lista_precio_id=$request->lista_precio_id;
				 $Ventas->estado_id=$request->estado_id;
				 $Ventas->updated_at=$request->updated_at;
				 $Ventas->created_at=$request->created_at;
				
		  
			$Ventas->save();
			return response()->json($Ventas);
		}
	}

	public function destroy($id){
		$Ventas = VentasModel::findOrFail($id);
		$Ventas->delete();
		return response()->json($Ventas);
	}

}


