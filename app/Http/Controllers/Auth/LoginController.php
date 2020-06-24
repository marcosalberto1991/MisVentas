<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\PerfilUsuarioModel;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    //protected $redirectTo = 'Solicitude_estado';
    protected $redirectTo = 'dashboard';
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
//        echo "como esta tu";
    }
    protected function sendLoginResponse(Request $request){
    $request->session()->regenerate();
    $user = auth()->user()->id;
    /*
     
    if($Perfil_Usuario = PerfilUsuarioModel::where('users_id', $user)->first()){
    session([
        'aaa' => "$Perfil_Usuario->entidad_municipal_id",
        'nombre' => "$Perfil_Usuario->nombre",
        'apellido' => "$Perfil_Usuario->apellido",
        'municipios_id' => "$Perfil_Usuario->municipios_id",
        'entidad_municipal_id' => "$Perfil_Usuario->entidad_municipal_id",
        'foto' => "$Perfil_Usuario->foto",
    ]);

    }else{

         session([
        'aaa' => "",
        'nombre' => "",
        'apellido' => "",
        'municipios_id' => "",
        'entidad_municipal_id' => "",
        'foto' => "",
    ]);

        $PerfilUsuarioModel = new PerfilUsuarioModel();
        $PerfilUsuarioModel->nombre="";
        $PerfilUsuarioModel->apellido="";
        $PerfilUsuarioModel->telefono_1="";
        $PerfilUsuarioModel->telefono_2="";
        $PerfilUsuarioModel->direccion="";
        $PerfilUsuarioModel->cedula="";
        $PerfilUsuarioModel->municipios_id="553";
        $PerfilUsuarioModel->entidad_municipal_id="1";
        $PerfilUsuarioModel->foto="";
        $PerfilUsuarioModel->users_id=$user;
        $PerfilUsuarioModel->save();

    }
    */

    
    $this->clearLoginAttempts($request);
    //var_dump($request);
    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'user' => $this->guard()->user(),
        ]);
    }

    return $this->authenticated($request, $this->guard()->user())
        ?: redirect()->intended($this->redirectPath());
}

/**
 * Get the failed login response instance.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
   
}
