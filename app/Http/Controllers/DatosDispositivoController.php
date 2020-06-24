<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;

use App\DatosDispositivoModel;
use App\DispositivoModel;
use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class DatosDispositivoController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	   


	}
	/**
	* @var array
	*/
	protected $rules =
	[
		
				'nivel_rio' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'velocidad_corriente' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'temperatura' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			'dispositivo_id' => 'required|min:1|max:99999999',
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		//$id_tipo = Solicitude_tipo::select("solicitude_tipos.id","solicitude_tipos.descripcion as nombre")->get();

		//select('datos_dispositivo_bolla.*',"sum('velocidad_corriente.temperatura)")
		$DatosDispositivo = DatosDispositivoModel::with('dispositivo_id_pk')->get();

		$dispositivo_id = DatosDispositivoModel::select("id","id as nombre")->get();
		   	
		return view('DatosDispositivo.index', [ "dispositivo_id" => $dispositivo_id, 'listmysql' => $DatosDispositivo] );

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(){
		
	}
	 /**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$DatosDispositivo = new DatosDispositivoModel();
			
			 $DatosDispositivo->nivel_rio=$request->nivel_rio;
				 $DatosDispositivo->velocidad_corriente=$request->velocidad_corriente;
				 $DatosDispositivo->temperatura=$request->temperatura;
				 $DatosDispositivo->dispositivo_id=$request->dispositivo_id;
				
			$DatosDispositivo->save();
			return response()->json($DatosDispositivo);
		}
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function DatosGrafica()
	{

		/*
		$datosdispositivo = DispositivoModel::with('datos_dispositivo_bolla_pk')
		->whereHas('datos_dispositivo_bolla_pk', function($q) {
    		$q->limit(2);
		})
		->get();
		*/
		$datosdispositivo = DatosDispositivoModel::with('dispositivo_id_pk')
		->groupBy("dispositivo_id")
        ->orderBy('dispositivo_id', 'DESC')
		->get();

		$dispositivo=DispositivoModel::where('estado_id',1)->get()->toArray();

		$fecha_dispositivo = DatosDispositivoModel::select('created_at')->orderBy('created_at', 'DESC')
		->limit(8)
		//->pluck('created_at')
		->get()
		->toArray();
		//var_dump($fecha_dispositivo);
		//echo $fecha_dispositivo['created_at'];
		//echo('<pre>');var_dump($fecha_dispositivo);echo('</pre>');exit();


		foreach($dispositivo as $key => $data) {
			
			$dispositivo[$key]['datos_bolla']=DatosDispositivoModel::where('dispositivo_id',$data['id'])->orderBy('id', 'DESC')
		->limit(8)
		->get()->toArray();
		}		
		
		/*
		$datosdispositivo_grafica = DatosDispositivoModel::with('dispositivo_id_pk')
		->groupBy("dispositivo_id")
        ->orderBy('dispositivo_id', 'DESC')
		->get();
		*/





		//var_dump($datosdispositivo);exit();
		

		return view('DatosDispositivo.grafica', [
			'fecha_dispositivo' => $fecha_dispositivo,
			'datosdispositivo' => $datosdispositivo,
			'dispositivo' => $dispositivo,
		]);
	}
	public function show($id)
	{
		$DatosDispositivo = DatosDispositivoModel::findOrFail($id);

		return view('DatosDispositivo.show', ['DatosDispositivoModel' => $DatosDispositivo]);
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$DatosDispositivo = DatosDispositivoModel::findOrFail($id);
			
			 $DatosDispositivo->nivel_rio=$request->nivel_rio;
				 $DatosDispositivo->velocidad_corriente=$request->velocidad_corriente;
				 $DatosDispositivo->temperatura=$request->temperatura;
				 $DatosDispositivo->dispositivo_id=$request->dispositivo_id;
				
		  
			$DatosDispositivo->save();
			return response()->json($DatosDispositivo);
		}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$DatosDispositivo = DatosDispositivoModel::findOrFail($id);
		$DatosDispositivo->delete();
		return response()->json($DatosDispositivo);
	}
	/**
	* Change resource status. DatosDispositivoModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		$id = Input::get('id');

		$DatosDispositivo = DatosDispositivoModel::findOrFail($id);
		$DatosDispositivo->is_published = !$DatosDispositivoModel->is_published;
		$DatosDispositivo->save();

		return response()->json($DatosDispositivo);
	}
}


