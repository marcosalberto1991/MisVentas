<?php
namespace App\Http\Controllers;
use App\Http\Resources\punto as puntoResource;
use App\punto;
use App\VentasModel;
use App\Ventas_has_productoModel;
use Illuminate\Http\Request;
class ventaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vista()
    {
        return view('punto.vista', []);
    }
    public function obtener_data()
    {
        $ventas = VentasModel::with('ventas_has_producto_all.producto_id_pk', 'mesa_id_pk')->orderBy('mesa_id','asc')->where('estado_id', 1)->paginate(20);
        foreach ($ventas as $key => $value) {
            $suma = 0;
            $ventas_has_producto = Ventas_has_productoModel::with('producto_id_pk')->where('ventas_id', $value->id)->get();
            foreach ($ventas_has_producto as $ventas_id => $venta) {
                $suma += $venta['cantidad'] * $venta['precio'];
            }
            $ventas[$key]['total_ventas'] = $suma;
        }
        return response()->json($ventas);
    }
    public function index()
    {
        // Get puntos
        $puntos = punto::orderBy('created_at', 'desc')->paginate(3);
        //$puntos = punto::orderBy('created_at', 'desc')->paginate(3);
        $ventas = VentasModel::with('ventas_has_producto_all.producto_id_pk', 'mesa_id_pk')->paginate(3);
        // Return collection of puntos as a resource
        return puntoResource::collection($puntos);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $punto = $request->isMethod('put') ? punto::findOrFail($request->punto_id) : new punto;
        $punto->id = $request->input('punto_id');
        $punto->title = $request->input('title');
        $punto->body = $request->input('body');
        if ($punto->save()) {
            return new puntoResource($punto);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get punto
        $punto = punto::findOrFail($id);
        // Return single punto as a resource
        return new puntoResource($punto);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get punto
        $punto = punto::findOrFail($id);
        if ($punto->delete()) {
            return new puntoResource($punto);
        }
    }
}