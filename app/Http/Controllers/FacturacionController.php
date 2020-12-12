<?php
namespace App\Http\Controllers;

use App\FacturacionModel;
use App\Metodo_PagoModel;
use App\ProveedorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;
use View;

class FacturacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $rules =
        [
        'fecha' => 'required|min:2|max:255',
        //    'proveedor_id' => 'required|min:1|max:99999999',
        'metodo_pago_id' => 'required|min:1|max:99999999',

        //regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/

    ];

    public function index()
    {
        return view('Facturacion.index', []);
    }
    public function consulta(Request $request)
    {
        $consulta_data = $request->get("consulta_data");
        if ($consulta_data == "") {
            $data = FacturacionModel::with('proveedor_id')->paginate(20);
        } else {
            $data = FacturacionModel::where("id", 1)
            //->orwhere("id","like","%". $consulta_data."%")
                ->orwhere("fecha", "like", "%" . $consulta_data . "%")
                ->orwhere("proveedor_id", "like", "%" . $consulta_data . "%")
                ->orwhere("metodo_pago_id", "like", "%" . $consulta_data . "%")

                ->paginate(20);
        }

        return response()->json($data);
    }
    public function create()
    {
        $data_foraneos = [
            "proveedor_id" => ProveedorModel::select("id", "id as nombre", "nombre as text")->get(),
            "metodo_pago_id" => Metodo_PagoModel::select("id", "id as nombre", "nombre as text")->get(),
            //    "producto_id"=>Productomodel::select("id","id as nombre","nombre as text")->get(),

            //"departamento_id" => DepartamentoModel::select("id_departamento as id","departamento as text")->get(),
        ];
        return response()->json($data_foraneos);

    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

            $Facturacion = new FacturacionModel();
            $Facturacion->fecha = $request->fecha;
            $Facturacion->proveedor_id = $request->proveedor_id;
            $Facturacion->metodo_pago_id = $request->metodo_pago_id;
            $Facturacion->save();
            return response()->json($Facturacion);
        }
    }
    public function show($id)
    {
        return response()->json(FacturacionModel::findOrFail($id));
    }

    public function edit($id)
    {}

    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

            $Facturacion = FacturacionModel::findOrFail($id);

            $Facturacion->fecha = $request->fecha;
            $Facturacion->proveedor_id = $request->proveedor_id;
            $Facturacion->metodo_pago_id = $request->metodo_pago_id;

            $Facturacion->save();
            return response()->json($Facturacion);
        }
    }

    public function destroy($id)
    {
        $Facturacion = FacturacionModel::findOrFail($id);
        $Facturacion->delete();
        return response()->json($Facturacion);
    }

}
