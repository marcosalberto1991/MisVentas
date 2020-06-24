<?php
namespace App\Http\Controllers;
use App\AuditoriaModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PDF;
use Response;
use Validator;
use View;

class AuditoriaController extends Controller {
    public function __construct() {
        $this->middleware('auth');

    }
    /**
     * @var array
     */
    protected $rules =
        [

        'id'             => 'required|min:1|max:99999999',
        'user_type'      => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'user_id'        => 'required|min:1|max:99999999',
        'event'          => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'auditable_id'   => 'required|min:1|max:99999999',
        'auditable_type' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'ip_address'     => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'user_agent'     => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'tags'           => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',

    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        //$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

        $event          = AuditoriaModel::select("event as id", "event as nombre")->groupBy('event')->get();
        $auditable_type = AuditoriaModel::select("auditable_type as id", "auditable_type as nombre")->groupBy('auditable_type')->get();
        $usuario        = User::select("id", "name as nombre")->groupBy('name')->get();

        $Auditoria = AuditoriaModel::with('user_id_pk')->get();

        $user_id      = AuditoriaModel::select("id", "id as nombre")->get();
        $auditable_id = AuditoriaModel::select("id", "id as nombre")->get();

        $fecha_inicial_f = "";
        $fecha_final_f   = "";
        if ($request->isMethod('post')) {

            $fecha_inicial_f = Input::post('fecha_inicial');
            $fecha_final_f   = Input::post('fecha_final');
            $usuario_f       = Input::post('usuario');
            $modelo_f        = Input::post('modelo');
            $fecha_sq        = true;
            if (isset($fecha_inicial_f) == false) {
                $fecha_inicial_f = "";
            }
            if (isset($fecha_final_f) == false) {
                $fecha_final_f = "";
            }
            if (isset($usuario_f) == false) {
                $usuario_f = [0];
                $fecha_sq  = false;
            }
            if (isset($modelo_f) == false) {
                $modelo_f = [0];
                $fecha_sq = false;
            }

            if ($fecha_sq == false) {
                $data = AuditoriaModel::WhereIn("auditable_type", $modelo_f)
                    ->whereBetween('created_at', array($fecha_inicial_f . ' 00:00:00', $fecha_final_f . ' 23:59:59'))
                    ->orWhereIn("user_id", $usuario_f)
                    ->whereBetween('created_at', array($fecha_inicial_f . ' 00:00:00', $fecha_final_f . ' 23:59:59'))
                    ->with('user_id_pk')
                    ->get();
            } else {
                $data = AuditoriaModel::whereBetween('created_at', array($fecha_inicial_f . ' 00:00:00', $fecha_final_f . ' 23:59:59'))
                    ->orWhereIn("auditable_type", $modelo_f)
                    ->whereBetween('created_at', array($fecha_inicial_f . ' 00:00:00', $fecha_final_f . ' 23:59:59'))
                    ->orWhereIn("user_id", $usuario_f)
                    ->whereBetween('created_at', array($fecha_inicial_f . ' 00:00:00', $fecha_final_f . ' 23:59:59'))
                    ->with('user_id_pk')
                    ->get();
            }

        }

        return view('Auditoria.index', [
            "user_id"         => $user_id,
            "auditable_id"    => $auditable_id,
            "listmysql"       => $Auditoria,
            "event"           => $event,
            "auditable_type"  => $auditable_type,
            "usuario"         => $usuario,
            "fecha_inicial_f" => $fecha_inicial_f,
            "fecha_final_f"   => $fecha_final_f,

        ]);

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
            $Auditoria = new AuditoriaModel();

            $Auditoria->user_type      = $request->user_type;
            $Auditoria->user_id        = $request->user_id;
            $Auditoria->event          = $request->event;
            $Auditoria->auditable_id   = $request->auditable_id;
            $Auditoria->auditable_type = $request->auditable_type;
            $Auditoria->old_values     = $request->old_values;
            $Auditoria->new_values     = $request->new_values;
            $Auditoria->url            = $request->url;
            $Auditoria->ip_address     = $request->ip_address;
            $Auditoria->user_agent     = $request->user_agent;
            $Auditoria->tags           = $request->tags;
            $Auditoria->created_at     = $request->created_at;
            $Auditoria->updated_at     = $request->updated_at;

            $Auditoria->save();
            return response()->json($Auditoria);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $Auditoria = AuditoriaModel::findOrFail($id);

        return view('Auditoria.show', ['AuditoriaModel' => $Auditoria]);
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
            $Auditoria = AuditoriaModel::findOrFail($id);

            $Auditoria->user_type      = $request->user_type;
            $Auditoria->user_id        = $request->user_id;
            $Auditoria->event          = $request->event;
            $Auditoria->auditable_id   = $request->auditable_id;
            $Auditoria->auditable_type = $request->auditable_type;
            $Auditoria->old_values     = $request->old_values;
            $Auditoria->new_values     = $request->new_values;
            $Auditoria->url            = $request->url;
            $Auditoria->ip_address     = $request->ip_address;
            $Auditoria->user_agent     = $request->user_agent;
            $Auditoria->tags           = $request->tags;
            $Auditoria->created_at     = $request->created_at;
            $Auditoria->updated_at     = $request->updated_at;

            $Auditoria->save();
            return response()->json($Auditoria);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $Auditoria = AuditoriaModel::findOrFail($id);
        $Auditoria->delete();
        return response()->json($Auditoria);
    }

    /**
     * Change resource status. AuditoriaModel
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus() {
        $id = Input::get('id');

        $Auditoria               = AuditoriaModel::findOrFail($id);
        $Auditoria->is_published = !$AuditoriaModel->is_published;
        $Auditoria->save();

        return response()->json($Auditoria);
    }
    public function pdf(Request $request) {
        //    $Auditoria = AuditoriaModel::all();

        $event          = AuditoriaModel::select("id", "event as nombre")->groupBy('event')->get();
        $auditable_type = AuditoriaModel::select("id", "auditable_type as nombre")->groupBy('auditable_type')->get();
        $usuario        = User::select("id", "name as nombre")->groupBy('name')->get();

        return view('Auditoria.pdf', [
            "event"          => $event,
            "auditable_type" => $auditable_type,
            "usuario"        => $usuario,
//            'listmysql' => $Auditoria
        ]);

    }
}
