<?php
namespace App\Http\Controllers;
use App\Ventas_has_productoModel;
use App\VentasModel;
use Illuminate\Http\Request;

class Ventas_has_productoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $ventas=Ventas_has_productoModel::with('ventas_id_pk.mesa_id_pk')->get();
        foreach ($ventas as $key => $value) {
            $ventas->$key->total_mesa="mañana";
        }
        return $ventas;
    }
    public function cobra_todo(Request $request,$ventas_id)
    {
        $ventas=VentasModel::where('id',$ventas_id)->first();
        $ventas->estado_id=2;
        $ventas->mesa_id;
        $ventas->save();
        /*
        $new_mesa= new VentasModel();
        $new_mesa->mesa_id=$ventas->mesa_id;
        $new_mesa->estado_id=1;
        $new_mesa->save();
        */
        return $ventas;
    }
    public function duplicar_productos(Request $request){

        $thought = new Ventas_has_productoModel();
        $thought->producto_id = $request->producto_id;
        $thought->ventas_id = $request->ventas_id;
        $thought->cantidad = $request->cantidad;
        $thought->precio = $request->precio;
        
        //$thought->user_id = auth()->id();
        $thought->save();
    }
    public function store(Request $request)
    {
        $thought = new Ventas_has_productoModel();
        $thought->producto_id = $request->producto_id;
        $thought->ventas_id = $request->ventas_id;
        $thought->cantidad = $request->cantidad;
        $thought->precio = $request->precio;

        //$thought->user_id = auth()->id();
        $thought->save();
        $thought=VentasModel::with('mesa_id_pk','ventas_has_producto_all.producto_id_pk')->get();
        return $thought;
    }
    public function lista_mesa_add($mesa_id){
        
        $venta_f=VentasModel::where('mesa_id',$mesa_id)->where('estado_id',1)->first();
        if (!$venta_f) {
            
            $venta= new VentasModel();
            $venta->mesa_id=$mesa_id;
            $venta->estado_id=1;
            $venta->save();
            return $venta;
        }else{
            return json_encode(["nombre"=>"false"]);
        }
    }
    public function update(Request $request, $id)
    {
        $thought = Ventas_has_productoModel::find($id);
        $thought->producto_id = $request->producto_id;
        //$thought->ventas_id = $request->ventas_id;
        $thought->cantidad = $request->cantidad;
        $thought->precio = $request->precio;

        $thought->save();
        return $thought;
    }
    public function destroy(Request $request,$id)
    {
        $thought = Ventas_has_productoModel::find($id);
        $thought->delete();
        return $thought;
        foreach ($variable as $key => $value) {
            # code...
        }
    }
}