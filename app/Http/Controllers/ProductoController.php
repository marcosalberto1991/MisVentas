<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\ProductoModel;
use View;
use App\HasRoles;
use App\AuditoriaModel;
use App\Roles;
use App\ProveedorModel;
use App\User;
use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class ProductoController extends Controller {
	public function __construct(){
		$this->middleware('auth');
	}
	   
	protected $rules =
	[
	//	'id' => 'required|min:1|max:99999999',
	//	'id' => 'required|min:2|max:255',
		'nombre_proveedor' => 'required|min:2|max:255',
		'nombre' => 'required|min:2|max:255',
		//'imagen' => 'required|min:2|max:255',
		//'precio_caja' => 'required|min:1|max:99999999',
		//'precio_caja' => 'required|min:2|max:255',
		/*'cantidad_caja' => 'required|min:1|max:99999999',
		'cantidad_caja' => 'required|min:2|max:255',
		'precio_unidad' => 'required|min:1|max:99999999',
		'precio_unidad' => 'required|min:2|max:255',
		'iva' => 'required|min:1|max:99999999',
		'iva' => 'required|min:2|max:255',
		'porcentaje_ganacia' => 'required|min:1|max:99999999',
		'porcentaje_ganacia' => 'required|min:2|max:255',
		'precio_venta' => 'required|min:1|max:99999999',
		'precio_venta' => 'required|min:2|max:255',
		'precio_venta_2' => 'required|min:1|max:99999999',
		'precio_venta_2' => 'required|min:2|max:255',
		'ganacia' => 'required|min:1|max:99999999',
		'ganacia' => 'required|min:2|max:255',
		'proveedor_id' => 'required|min:1|max:99999999',
		'proveedor_id' => 'required|min:2|max:255',
		'created_at' => 'required|min:2|max:255',
		'updated_at' => 'required|min:2|max:255',
          */
    //regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/
    
	];

	public function index(){
		return view('Producto.index', [] );
  	}
  public function consulta(Request $request){
    $consulta_data=$request->get("consulta_data");
    if($consulta_data==""){
      $data=ProductoModel::paginate(20);
    }else{
      $data=ProductoModel::where("id",1)
      ->orwhere("id","like","%". $consulta_data."%")
        ->orwhere("nombre_proveedor","like","%". $consulta_data."%")
        ->orwhere("nombre","like","%". $consulta_data."%")
        ->orwhere("imagen","like","%". $consulta_data."%")
        ->orwhere("precio_caja","like","%". $consulta_data."%")
        ->orwhere("cantidad_caja","like","%". $consulta_data."%")
        ->orwhere("precio_unidad","like","%". $consulta_data."%")
        ->orwhere("iva","like","%". $consulta_data."%")
        ->orwhere("porcentaje_ganacia","like","%". $consulta_data."%")
        ->orwhere("precio_venta","like","%". $consulta_data."%")
        ->orwhere("precio_venta_2","like","%". $consulta_data."%")
        ->orwhere("ganacia","like","%". $consulta_data."%")
        ->orwhere("proveedor_id","like","%". $consulta_data."%")
        ->orwhere("created_at","like","%". $consulta_data."%")
        ->orwhere("updated_at","like","%". $consulta_data."%")
        
      ->paginate(20);
    } 
    
    return response()->json($data);
  }
	public function create(){
    $data_foraneos = [
      "proveedor_id" => ProveedorModel::select("id","id as nombre","nombre as text")->get(),
        
      //"departamento_id" => DepartamentoModel::select("id_departamento as id","departamento as text")->get(),
		];
		return response()->json($data_foraneos);

  }

	public function store(Request $request){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
     
      
		  
		$Producto = new ProductoModel();

		$file2 = Input::file('imagen');
		if (isset($file2)) {
			$codigo=str_random(5);
			$nombre_original=$file2->getClientOriginalName();
			$nombres = $nombre_original.$codigo. '.' . $file2->getClientOriginalExtension();
        	\Storage::disk('intervenir')->put($nombres, \File::get($file2));
			$Producto->imagen = $nombres;  
		}

		$request->precio_caja = str_replace(".", "", $request->precio_caja);
		$request->precio_caja = str_replace("$", "", $request->precio_caja);

		$request->precio_venta = str_replace(".", "", $request->precio_venta);
		$request->precio_venta = str_replace("$", "", $request->precio_venta);

		$request->precio_venta_2 = str_replace(".", "", $request->precio_venta_2);
		$request->precio_venta_2 = str_replace("$", "", $request->precio_venta_2);
		
		$Producto->nombre_proveedor=$request->nombre_proveedor;
		$Producto->nombre=$request->nombre;
		//$Producto->imagen=$request->imagen;
		$Producto->precio_caja=$request->precio_caja;
		$Producto->cantidad_caja=$request->cantidad_caja;
		$Producto->precio_unidad=$request->precio_unidad;
		$Producto->iva=$request->iva;
		$Producto->porcentaje_ganacia=$request->porcentaje_ganacia;
		$Producto->precio_venta=$request->precio_venta;
		$Producto->precio_venta_2=$request->precio_venta_2;
		$Producto->ganacia=$request->ganacia;
		$Producto->proveedor_id=$request->proveedor_id;
		$Producto->stock=$request->stock;
		$Producto->cantidad_disponible=$request->cantidad_disponible;
		
		
		$Producto->save();
		return response()->json($Producto);
		}
	}
  public function show($id){
		$data = ProductoModel::findOrFail($id);
		
		$data->auditoria = AuditoriaModel::where('auditable_type','App\ProductoModel')
		->where('auditable_id',$id)
		->get();
		//var_dump($data);
        return response()->json($data);
    }
  
	public function productos_all(){
		$Producto = ProductoModel::pluck('nombre','id');		
		$Producto = ProductoModel::select('id','nombre')->get();		
		$Producto = ProductoModel::select('id','nombre','nombre as text')->get();		
		return response()->json($Producto);
	}
  public function edit($id){}

    public function update(Request $request, $id){
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$Producto = ProductoModel::findOrFail($id);
			

			$file2 = Input::file('imagen');
			if (isset($file2)) {
				$codigo=str_random(5);
				$nombre_original=$file2->getClientOriginalName();
				$nombres = $nombre_original.$codigo. '.' . $file2->getClientOriginalExtension();
				\Storage::disk('intervenir')->put($nombres, \File::get($file2));
				$Producto->imagen = $nombres;  
			}
			$request->precio_caja = str_replace(".", "", $request->precio_caja);
			$request->precio_caja = str_replace("$", "", $request->precio_caja);
	
			$request->precio_venta = str_replace(".", "", $request->precio_venta);
			$request->precio_venta = str_replace("$", "", $request->precio_venta);
	
			$request->precio_venta_2 = str_replace(".", "", $request->precio_venta_2);
			$request->precio_venta_2 = str_replace("$", "", $request->precio_venta_2);
			
			$Producto->nombre_proveedor=$request->nombre_proveedor;
			$Producto->nombre=$request->nombre;
			//$Producto->imagen=$request->imagen;
			$Producto->precio_caja=$request->precio_caja;
			$Producto->cantidad_caja=$request->cantidad_caja;
			$Producto->precio_unidad=$request->precio_unidad;
			$Producto->iva=$request->iva;
			$Producto->porcentaje_ganacia=$request->porcentaje_ganacia;
			$Producto->precio_venta=$request->precio_venta;
			$Producto->precio_venta_2=$request->precio_venta_2;
			$Producto->ganacia=$request->ganacia;
			$Producto->stock=$request->stock;
			$Producto->cantidad_disponible=$request->cantidad_disponible;
			$Producto->proveedor_id=$request->proveedor_id;
			$Producto->created_at=$request->created_at;
			$Producto->updated_at=$request->updated_at;

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


