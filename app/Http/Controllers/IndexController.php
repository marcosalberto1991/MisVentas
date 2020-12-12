<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use Alert;
use Carbon\Carbon;
use App\DatosDispositivoModel;
use App\DispositivoModel;
use View;
use App\ProductosModel;
use App\VentaModel;
use App\Estado_ventaModel;
use App\Productos_has_ventaModel;
use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;
class IndexController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('web');
    }
    protected $rules =[
		
		'productos_id' => 'required|min:1|max:99999999',
	   	//'venta_id' => 'min:1|max:99999999',
	   	'cantidad' => 'required|min:1|max:99999999',
	   	//'precio_producto' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   	//'estado_venta_id' => 'required|min:1|max:99999999',
		
	];


    public function Templete_Ajuste(Request $request) {
       //echo auth()->user()->id";



        $user = User::findOrFail(auth()->user()->id);
        //var_dump($user);exit();
        if($request->theme=='v'){
        $user->color_app_vertical=$request->color_app;}
        if($request->theme=='h'){
        $user->color_app_horizontal=$request->color_app;}
        $user->save();
        return response()->json($user);

       
       
        
    }
    public function index() {
        return view('inicio', [
        ]);
    }

    public function micarrito(){
        $this->middleware('auth');
        
        $venta_procesadas=VentaModel::where('users_id',auth()->user()->id)
        ->with('productos_has_venta_all.producto_id_pk')
        ->where('estado_venta_id',4)->get();
        
        $venta=VentaModel::where('users_id',auth()->user()->id)->where('estado_venta_id',1)->first();
        if(!$venta){
            $venta = new VentaModel();
            $venta->users_id=auth()->user()->id;
            $venta->estado_venta_id=1;
            $venta->save();
        }

        $venta_id = $venta->id;
        $Productos_has_venta = Productos_has_ventaModel::with('venta_id_pk','producto_id_pk')->where('venta_id',$venta_id)->get();
        
        //var_dump($Productos_has_venta);exit();
        $productos_id = ProductosModel::select("id","nombre")->get();
		$venta_id = ventaModel::select("id","fecha_venta as nombre")->get();
		$estado_venta_id = Estado_ventaModel::select("id","nombre")->get();
		   	
		return view('Index.micarrito', [ 
            "venta_procesadas"=>$venta_procesadas,
            "productos_id" => $productos_id,
            "venta_id" => $venta_id,"estado_venta_id" => $estado_venta_id, 'listmysql' => $Productos_has_venta] );

    }
    public function procesar_compra(Request $request){
        $venta=ventaModel::where('users_id',auth()->user()->id)->where('estado_venta_id',1)->first();
        $venta->estado_venta_id=4;
        $venta->fecha_venta=Carbon::now();
        $venta->save();



        $venta_id = $venta->id;
        $Productos_has_venta = Productos_has_ventaModel::with('venta_id_pk','producto_id_pk')->where('venta_id',$venta_id)->get();
        
        foreach ($Productos_has_venta as $key => $value) {
            //echo $value->id;
            //echo "<br>";
            //echo  $value->producto_id_pk->precio_venta;

            $Productos = Productos_has_ventaModel::findOrFail($value->id);
            $Productos->precio_producto=$value->producto_id_pk->precio_venta;
            $Productos->estado_venta_id=4; //vendido
            $Productos->save();


        }
        
        
        Alert::message('Compra realizada con exitos', 'Operacion exitosa')->autoclose(3000);
        return redirect()->back();

    }
    public function Inventario(){
        $productos=ProductosModel::with('entrada_all','productos_has_venta_all')->get();

        return view('Index.inventario', [ 
            "productos"=>$productos
            ] );
        
    }
    
    public function store(Request $request){
        $this->middleware('auth');
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
            
            $venta=VentaModel::where('users_id',auth()->user()->id)->where('estado_venta_id',1)->first();
            if(!$venta){
                $venta = new VentaModel();
                $venta->users_id=auth()->user()->id;
                $venta->estado_venta_id=1;
                $venta->save();
            }

            $Productos_has_venta =new Productos_has_ventaModel();
            $Productos_has_venta->venta_id=$venta->id;
            $Productos_has_venta->productos_id=$request->productos_id;
            $Productos_has_venta->cantidad=$request->cantidad;
            $Productos_has_venta->estado_venta_id=1;
            $Productos_has_venta->save();

            Alert::message('Compra realizada con exitos', 'Operacion exitosa')->autoclose(3000);
            return redirect()->back();
		}
	}
}
