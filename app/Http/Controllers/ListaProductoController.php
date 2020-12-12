<?php
namespace App\Http\Controllers;

use App\ListaProductoModel;
use App\ProductoModel;
use Illuminate\Http\Request;
use Response;
use Validator;
use View;

class ListaProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $rules =
        [
        'orden' => 'required|min:1|max:99999999',
        'producto_id' => 'required|min:1|max:99999999',
    ];

    public function index()
    {
        return view('inicio', []);
    }
    public function consulta(Request $request)
    {
        $consulta_data = $request->get("consulta_data");
        if ($consulta_data == "") {
            $data = ListaProductoModel::with('producto_id')->paginate(20);
        } else {
            $data = ListaProductoModel::with('producto_id')->where("id", 1)
                ->orwhere("id", "like", "%" . $consulta_data . "%")
                ->orwhere("orden", "like", "%" . $consulta_data . "%")
                ->orwhere("created_at", "like", "%" . $consulta_data . "%")
                ->orwhere("updated_at", "like", "%" . $consulta_data . "%")
                ->orwhere("producto_id", "like", "%" . $consulta_data . "%")

                ->paginate(20);
        }

        return response()->json($data);
    }

    public function data_foraneos()
    {
        $data_foraneos = [
            "producto_id" => ProductoModel::select("id", "id as value", "nombre as text")->get(),

            //"departamento_id" => DepartamentoModel::select("id_departamento as id","departamento as text")->get(),
        ];
        return response()->json($data_foraneos);

    }
    public function create()
    {
		$data_foraneos = [
            "producto_id" => ProductoModel::select("id","nombre as text")->get(),
            //"departamento_id" => DepartamentoModel::select("id_departamento as id","departamento as text")->get(),
        ];
        return response()->json($data_foraneos);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

            $ListaProducto = new ListaProductoModel();

            $ListaProducto->orden = $request->orden;
            $ListaProducto->producto_id = $request->producto_id;

            $ListaProducto->save();
            return response()->json($ListaProducto);
        }
    }
    public function show($id)
    {
        return response()->json(ListaProductoModel::findOrFail($id));
    }

    public function edit($id)
    {
        return view("ListaProducto.index", []);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $ListaProducto = ListaProductoModel::findOrFail($id);
            $ListaProducto->orden = $request->orden;
            $ListaProducto->producto_id = $request->producto_id;
            $ListaProducto->save();
            return response()->json($ListaProducto);
        }
    }

    public function destroy($id)
    {
        $ListaProducto = ListaProductoModel::findOrFail($id);
        $ListaProducto->delete();
        return response()->json($ListaProducto);
    }

}
