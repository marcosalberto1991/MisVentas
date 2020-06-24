<?php
namespace App\Http\Controllers;
use App\Empresa_municipalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Session;
use Validator;
use View;

class dashboardController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * @var array
     */
    protected $rules = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('dashboard', []);
    }
    public function documentacion() {
        return view('Documentacion.index', []);
    }
    public function show($id) {
        //echo "string";
        //return view('Empresa_municipal.index', ['listmysql' => $Empresa_municipal] );

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $Empresa_municipal = new Empresa_municipalModel();

            $Empresa_municipal->nombre_empresa       = $request->nombre_empresa;
            $Empresa_municipal->direccion            = $request->direccion;
            $Empresa_municipal->nit                  = $request->nit;
            $Empresa_municipal->telefono             = $request->telefono;
            $Empresa_municipal->email                = $request->email;
            $Empresa_municipal->actividad_economica  = $request->actividad_economica;
            $Empresa_municipal->municipios_id        = $request->municipios_id;
            $Empresa_municipal->users_id             = $request->users_id;
            $Empresa_municipal->Entidad_municipal_id = Session::get('entidad_id');

            $Empresa_municipal->save();
            return response()->json($Empresa_municipal);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSw($id) {
        //$Empresa_municipal = Empresa_municipalModel::findOrFail($id);

        //return view('Empresa_municipal.show', ['Empresa_municipalModel' => $Empresa_municipal]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $Empresa_municipal = Empresa_municipalModel::findOrFail($id);

            $Empresa_municipal->nombre_empresa      = $request->nombre_empresa;
            $Empresa_municipal->direccion           = $request->direccion;
            $Empresa_municipal->nit                 = $request->nit;
            $Empresa_municipal->telefono            = $request->telefono;
            $Empresa_municipal->email               = $request->email;
            $Empresa_municipal->actividad_economica = $request->actividad_economica;
            $Empresa_municipal->municipios_id       = $request->municipios_id;
            $Empresa_municipal->users_id            = $request->users_id;

            $Empresa_municipal->save();
            return response()->json($Empresa_municipal);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $Empresa_municipal = Empresa_municipalModel::findOrFail($id);
        $Empresa_municipal->delete();
        return response()->json($Empresa_municipal);
    }

    /**
     * Change resource status. Empresa_municipalModel
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus() {
        $id = Input::get('id');

        $Empresa_municipal               = Empresa_municipalModel::findOrFail($id);
        $Empresa_municipal->is_published = !$Empresa_municipalModel->is_published;
        $Empresa_municipal->save();

        return response()->json($Empresa_municipal);
    }
}
