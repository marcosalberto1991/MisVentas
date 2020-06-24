<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;
use App\PerfilUsuarioModel;
use App\User;
use View;
use Hash;


class PerfilUsuariocontroller extends Controller {
    public function __construct() {
        $this->middleware('auth');

    }
    /**
     * @var array
     */
    protected $rules =
        [

        //'id' => 'required|min:1|max:99999999',
        'nombre'               => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'apellido'             => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'telefono_1'           => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'telefono_2'           => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'direccion'            => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'cedula'               => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        //'municipios_id'        => 'required|min:1|max:99999999',
        //'entidad_municipal_id' => 'required|min:1|max:99999999',
        //    'foto' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'users_id'             => 'required|min:1|max:99999999',
        //'file' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',

    ];


/*
     $Perfil_Usuario->nombre          = $request->nombre;
            $Perfil_Usuario->apellido        = $request->apellido;
            $Perfil_Usuario->cedula          = $request->cedula;
            $Perfil_Usuario->correo          = $request->correo;
            $Perfil_Usuario->celular         = $request->celular;
            $Perfil_Usuario->telefono_fijo   = $request->telefono_fijo;
            $Perfil_Usuario->direccion_correo= $request->direccion_correo;

*/

    public function rule(){
        return $rules =[
        'nombre' => 'required|min:2|max:8|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'apellido' => 'required|min:2|max:8|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'cedula' => 'required|min:2|max:191|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'correo' => 'required|min:2|email',
        'celular' => 'required|min:10|max:10|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'telefono_fijo' => 'required|min:2|max:6|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'direccion_correo' => 'required|min:2|max:191|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
        'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         
        ];

         
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

        $Perfil_Usuario       = PerfilUsuarioModel::all();
        //$municipios_id        = MunicipiosModel::select("id", "nombre")->get();
        //$entidad_municipal_id = Entidad_municipalModel::select("id", "nombre as nombre")->get();
        $users_id             = PerfilUsuarioModel::select("id", "id as nombre")->get()->first()->toArray();

        return view('Perfil_Usuario.index', [
            //"municipios_id" => $municipios_id, 
            //"entidad_municipal_id" => $entidad_municipal_id, 
            "users_id" => $users_id, 'listmysql' => $Perfil_Usuario]);

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
            $Perfil_Usuario = new PerfilUsuarioModel();

            $Perfil_Usuario->nombre               = $request->nombre;
            $Perfil_Usuario->apellido             = $request->apellido;
            $Perfil_Usuario->telefono_1           = $request->telefono_1;
            $Perfil_Usuario->telefono_2           = $request->telefono_2;
            $Perfil_Usuario->direccion            = $request->direccion;
            $Perfil_Usuario->cedula               = $request->cedula;
            $Perfil_Usuario->created_at           = $request->created_at;
            $Perfil_Usuario->updated_at           = $request->updated_at;
            $Perfil_Usuario->users_id             = $request->users_id;

            $Perfil_Usuario->save();
            return response()->json($Perfil_Usuario);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $Perfil_Usuario = PerfilUsuarioModel::findOrFail($id);

        return view('Perfil_Usuario.show', ['PerfilUsuarioModel' => $Perfil_Usuario]);
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
        $this->validate($request, $this->rule());

       
        $Perfil_Usuario = User::findOrFail($id);

        $file2 = Input::file('avatar');
        //$file2 = $request->file('avatar');
        if (isset($file2)) {
            $nombres = time() . str_random(5) . '.' . $file2->getClientOriginalExtension();
            \Storage::disk('perfil')->put($nombres, \File::get($file2));
            $Perfil_Usuario->avatar = $nombres;
        }
        $Perfil_Usuario->nombre          = $request->nombre;
        $Perfil_Usuario->apellido        = $request->apellido;
        $Perfil_Usuario->cedula          = $request->cedula;
        $Perfil_Usuario->correo          = $request->correo;
        $Perfil_Usuario->celular         = $request->celular;
        $Perfil_Usuario->telefono_fijo   = $request->telefono_fijo;
        $Perfil_Usuario->direccion_correo= $request->direccion_correo;
       
        $Perfil_Usuario->save();
        //return response()->json($Perfil_Usuario);
        //Perfil/Usuario

        return redirect('Perfil')->with('success','Datos de perfil modificado.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $Perfil_Usuario = PerfilUsuarioModel::findOrFail($id);
        $Perfil_Usuario->delete();
        return response()->json($Perfil_Usuario);
    }

    /**
     * Change resource status. PerfilUsuarioModel
     *
     * @return \Illuminate\Http\Response
     */
    public function DatosUsuario() {
        $user          = auth()->user()->id;
        $users         = auth()->user();
        $User= User::where('id', $user)->first();
        //$users_id      = User::where('users_id', $user)->select("id", "id as nombre")->get();

        return view('Perfil_Usuario.perfil', [
           // "municipios_id" => $municipios_id, 
            //"entidad_municipal_id" => $entidad_municipal_id, 
            "data_form" => $User, 
            "User" => $User, 
            //'listmysql' => $Perfil_Usuario
                ]);

    }
    public function subir() {

        $file   = Input::file('file');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('local')->put($nombre, \File::get($file));
        var_dump($nombre);

        $user           = auth()->user()->id;
        $Perfil_Usuario = PerfilUsuarioModel::findOrFail($user);

        $Perfil_Usuario->foto = $nombre;   
        $Perfil_Usuario->save();

        return response()->json($Perfil_Usuario);

    }
    public function Edit_password(Request $request){

         $Perfil_Usuario='true';
         $password=  $request->password;
         $password_new=     $request->password_new;
         $password_confirma=$request->password_confirma;
        //$request->password_actual=bcrypt($request->password_actual);
        if (!Hash::check($request->password, auth()->user()->password) ) {
            return redirect('Perfil/Usuario')->with('success','El password actual no coincide.');
        }
        
        $this->validate($request, [
        //'password' => 'required|confirmed',
        'password_new' => 'required', 
        'password_confirma' => 'required|same:password_new'
    ]);

            //$password_new=auth()->user()->password;
            if ($co=Hash::check($request->password, auth()->user()->password)){
                 request()->user()->fill([
                    'password' => Hash::make($password_new)
                ])->save();
            }
        return redirect('Perfil/Usuario')->with('success','El password se cambion con exito.');
        //return response()->json($co);


        
    }

}
