<?php
namespace App\Http\Controllers;

use App\CampoModel;
use App\FacturacionModel;
use App\Facturacion_ProductoModel;
use App\ProductoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;
use View;

class Facturacion_ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $rules =
        [

        'facturacion_id' => 'required|min:1|max:99999999',
        'producto_id' => 'required|min:1|max:99999999',

        //regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/

    ];

    public function index()
    {
        return view('Facturacion_Producto.index', []);
    }
    public function consulta(Request $request, $facturacion_id)
    {
        $consulta_data = $request->get("consulta_data");

        $facturacion_id = facturacionModel::where('id', $facturacion_id)->first()->toarray(); //->get();
        $campo = CampoModel::where('proveedor_id', $facturacion_id['proveedor_id'])->get();

        if ($consulta_data == "") {
            $data = Facturacion_ProductoModel::
                where('facturacion_id', $facturacion_id)
                ->with('producto_id')
                ->paginate(20);
        } else {
            $data = Facturacion_ProductoModel::with('producto_id')->where("id", 1)
                ->orwhere("id", "like", "%" . $consulta_data . "%")
                ->orwhere("facturacion_id", "like", "%" . $consulta_data . "%")
                ->orwhere("producto_id", "like", "%" . $consulta_data . "%")
                ->paginate(20);
        }
        $suma = Facturacion_ProductoModel::
            where('facturacion_id', $facturacion_id)->get()->toarray();
        $suma_total = 0;
        foreach ($suma as $key => $value) {
            $suma_total += $value['cantidad'] * $value['valor_unitario_con_iva'];
        }

        //$data['campo']=$campo;
        $data_f = [
            'consulta' => $data,
            'campo' => $campo,
            'suma_total' => $suma_total,
        ];

        return response()->json($data_f);
    }
    public function create()
    {
        $data_foraneos = [
            "facturacion_id" => FacturacionModel::select("id", "id as nombre", "id as text")->get(),
            "producto_id" => ProductoModel::select("id", "id as nombre", "nombre as text")->get(),

            //"departamento_id" => DepartamentoModel::select("id_departamento as id","departamento as text")->get(),
        ];
        return response()->json($data_foraneos);

    }
    public function buscar_producto($id)
    {
        $data = Facturacion_ProductoModel::where('id', $id)->first();
        return response()->json($data);

    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

        

            $Facturacion_Producto = new Facturacion_ProductoModel();
            $Facturacion_Producto->facturacion_id = $request->facturacion_id;
            $Facturacion_Producto->producto_id = $request->producto_id;
            $Facturacion_Producto->codigo_producto = $request->codigo_producto;

            $Facturacion_Producto->cantidad = $request->cantidad;
            $Facturacion_Producto->unidad_de_medida = $request->unidad_de_medida;
            $Facturacion_Producto->cantidad_por_unidad = $request->cantidad_por_unidad;
            $Facturacion_Producto->valor_unitario_sin_iva = $request->valor_unitario_sin_iva;
            $Facturacion_Producto->iva = $request->iva;
            $Facturacion_Producto->valor_unitario_con_iva = $request->valor_unitario_con_iva;
            $Facturacion_Producto->porcentaje_de_ganancia = $request->porcentaje_de_ganancia;
            $Facturacion_Producto->Valor_de_venta_calculado = $request->Valor_de_venta_calculado;
            $Facturacion_Producto->valor_de_venta = $request->valor_de_venta;
            $Facturacion_Producto->descuento = $request->descuento;
            $Facturacion_Producto->save();
            $id = $Facturacion_Producto->id;


            return response()->json($Facturacion_Producto);

        }
    }
    public function show($id)
    {
        return response()->json(Facturacion_ProductoModel::findOrFail($id));
    }
    public function buscar_producto_descricion(Request $request)
    {

        return response()->json(
            Facturacion_ProductoModel::where('producto_id', $request->producto_id)->orwhere('codigo_producto', $request->codigo_producto)->first()
        );
    }

    public function edit($id)
    {}

    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $Facturacion_Producto = Facturacion_ProductoModel::findOrFail($id);
            $Facturacion_Producto->facturacion_id = $request->facturacion_id;
            $Facturacion_Producto->producto_id = $request->producto_id;
            $Facturacion_Producto->codigo_producto = $request->codigo_producto;
            $Facturacion_Producto->cantidad = $request->cantidad;
            $Facturacion_Producto->unidad_de_medida = $request->unidad_de_medida;
            $Facturacion_Producto->cantidad_por_unidad = $request->cantidad_por_unidad;
            $Facturacion_Producto->valor_unitario_sin_iva = $request->valor_unitario_sin_iva;
            $Facturacion_Producto->iva = $request->iva;
            $Facturacion_Producto->valor_unitario_con_iva = $request->valor_unitario_con_iva;
            $Facturacion_Producto->porcentaje_de_ganancia = $request->porcentaje_de_ganancia;
            $Facturacion_Producto->Valor_de_venta_calculado = $request->Valor_de_venta_calculado;
            $Facturacion_Producto->valor_de_venta = $request->valor_de_venta;
            $Facturacion_Producto->descuento = $request->descuento;
            $Facturacion_Producto->save();
            return response()->json($Facturacion_Producto);
        }
    }

    public function destroy($id)
    {
        $Facturacion_Producto = Facturacion_ProductoModel::findOrFail($id);
        $Facturacion_Producto->delete();
        return response()->json($Facturacion_Producto);
    }

}
