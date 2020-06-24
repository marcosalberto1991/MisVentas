<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use PDF;

use App\ParqueaderoVehiculoModel;
use App\SitiosParqueaderoUsuarioModel;
use App\ZonaParqueaderoModel;
use App\CategoriaParqueaderoModel;
use App\TipoVehiculoModel;
use App\EstadoModel;
use App\RegistroModel;
use DateTime;
use Carbon\Carbon;

use View;


use App\HasRoles;
use App\Roles;
use App\User;

use Spatie\Permission\Namecontrollers\Role;
use Spatie\Permission\Namecontrollers\Permission;

class EntradaSalidaVehiculoController extends Controller
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
		
				//'id' => 'required|min:1|max:99999999',
	   			//'numero' => 'required|min:1|max:99999999',
	   			//'codigo' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.,()_-]*)*)+$/',
	   			//'categoria_parqueadero_id' => 'required|min:1|max:99999999',
	   			//'tipo_vehiculo_id' => 'required|min:1|max:99999999',
	   			//'estado_id' => 'required|min:1|max:99999999',
	   			
	];
	 /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){

		$sitio_parqueadero=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->first();
		$sitios_parqueadero_id=$sitio_parqueadero->sitios_parqueadero_id;

		$Sitios_Usuario=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->select('sitios_parqueadero_id')->get()->toArray();
		$zona_parqueadero_id = ZonaParqueaderoModel::wherein('id',[$Sitios_Usuario])->select('id')->get();
		$categoria_parqueadero_id=CategoriaParqueaderoModel::wherein('zona_parqueadero_sitios_parqueadero_id',$Sitios_Usuario)->select('id')->get();
		$ParqueaderoVehiculo =RegistroModel::where('sitios_parqueadero_id',$sitios_parqueadero_id)
		->where('estado_vehiculo',2)->get(); 
		//`registro` ORDER BY `registro`.`sitios_parqueadero_id` ASC 
		//ParqueaderoVehiculoModel::with('registro_all')->wherein('categoria_parqueadero_id',$categoria_parqueadero_id)
        //->where('estado_id',1)->where('estado_vehiculo',2)->get();


		$categoria_parqueadero_id = CategoriaParqueaderoModel::select("id","letra as nombre")->get();
		   	$tipo_vehiculo_id = TipoVehiculoModel::with('parqueadero_vehiculo_all')->where('sitios_parqueadero_id',$sitios_parqueadero_id)->get();
		   	$estado_id = EstadoModel::select("id","nombre")->get();
		   	
		return view('EntradaSalidaVehiculo.index', [ "categoria_parqueadero_id" => $categoria_parqueadero_id,"tipo_vehiculo_id" => $tipo_vehiculo_id,"estado_id" => $estado_id, 'listmysql' => $ParqueaderoVehiculo] );

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
	 public function store(Request $request){
        $this->validate($request, [
            //'nombre'=>'required | min:20 | max:120',
            //'email'=>'required|email|unique:users',
            ///'password'=>'required|min:6|confirmed'
            //'password' => 'min:6|required_with:password_confirmation|same:password_confirmation|confirmed',
            //'password_confirmation' => 'min:6'
        ]);

        $request->tipo_vehiculo_id;

        $Sitios_Usuario=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->select('sitios_parqueadero_id')->get()->toArray();
		$zona_parqueadero_id = ZonaParqueaderoModel::wherein('id',[$Sitios_Usuario])->select('id')->get();
		$categoria_parqueadero_id=CategoriaParqueaderoModel::wherein('zona_parqueadero_sitios_parqueadero_id',$Sitios_Usuario)->select('id')->get();
		$ParqueaderoVehiculo = ParqueaderoVehiculoModel::wherein('categoria_parqueadero_id',$categoria_parqueadero_id)
		->where('tipo_vehiculo_id',$request->tipo_vehiculo_id)
        ->where('estado_id',1)
        ->where('estado_vehiculo',1)
        ->with('registro_id_pk')
		->first();

		if (!is_null($ParqueaderoVehiculo)) {
			# code...

		$fecha=Carbon::now();
		//var_dump($fecha);
       	//exit();
		$ParqueaderoVehiculo = ParqueaderoVehiculoModel::findOrFail($ParqueaderoVehiculo->id);
		$ParqueaderoVehiculo->estado_vehiculo=2;
		$ParqueaderoVehiculo->save();

		$date = Carbon::now();
		$date = $date->format('Y-m-d');

		$sitio_parqueadero=SitiosParqueaderoUsuarioModel::where('user_id',auth()->user()->id)->first();
		$sitios_parqueadero_id=$sitio_parqueadero->sitios_parqueadero_id;

		$Registro = new RegistroModel();
		$Registro->sitios_parqueadero_id=$sitios_parqueadero_id;
		$Registro->fecha_ingreso=Carbon::now();
		$Registro->parqueadero_vehiculo_id =$ParqueaderoVehiculo->id ;
		$Registro->save();
		$Registro->user_id = 0 ;
		

		PDF::SetTitle('Resumer de barrios');
		PDF::SetFillColor(255, 255, 255);
        PDF::SetFont('times', 'BI', 20);
        //$txt = "Auditoria de SamanGir: $fecha_inicial A $fecha_final ";
        PDF::SetCreator(PDF_CREATOR);
        //PDF::SetAuthor('Nicola Asuni');
        PDF::SetTitle('TCPDF Example 029');
        PDF::SetSubject('TCPDF Tutorial');
        PDF::SetKeywords('TCPDF, PDF, example, test, guide');
        // set default header data

        PDF::SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 029', PDF_HEADER_STRING);
        //PDF::Header('/img/logo.png', 100, 'string to print as title on document header', 'string to print on document header');

        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
        PDF::SetFooterMargin(PDF_MARGIN_FOOTER);

        PDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        //PDF::setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //PDF::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        PDF::AddPage();
        PDF::SetAutoPageBreak(true, 20);
        PDF::SetFont('helvetica', 'BI', 14); //tipo de textos y tamaño

        PDF::Write(0, 'Ingreso de Parqueadero ', '', 0, 'C', true, 0, false, false, 0);
        PDF::Write(0, 'control de la entrada de parqueadero ', '', 0, 'C', true, 0, false, false, 0);
        PDF::Ln();

        PDF::setCellPaddings(1, 1, 1, 1);
        PDF::SetFont('helvetica', 'BI', 8); //tipo de textos y tamaño
        PDF::MultiCell(80, 4, 'fechad e ingreso : ', 1, 'L', 1, 0, '', '', true, 0, false, true, 10, 'T');
        PDF::MultiCell(80, 4, $Registro->fecha_ingreso , 1, 'L', 1, 1, '', '', true, 0, false, true, 10, 'T');
        PDF::MultiCell(80, 4, 'zona de parqueadero : ', 1, 'L', 1, 0, '', '', true, 0, false, true, 10, 'T');
        PDF::MultiCell(80, 4, $ParqueaderoVehiculo->codigo, 1, 'L', 1, 1, '', '', true, 0, false, true, 10, 'T');
        PDF::SetFont('helvetica', '', 8); //tipo de textos y tamaño

            $style = array(
		    'position' => '',
		    'align' => 'C',
		    'stretch' => false,
		    'fitwidth' => true,
		    'cellfitalign' => '',
		    'border' => true,
		    'hpadding' => 'auto',
		    'vpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255),
		    'text' => true,
		    'font' => 'helvetica',
		    'fontsize' => 8,
		    'stretchtext' => 4
		);
		PDF::Cell(0, 0, "$ParqueaderoVehiculo->codigo", 0, 1);
		PDF::write1DBarcode($ParqueaderoVehiculo->codigo, 'C39', '', '', '', 18, 0.4, $style, 'N');
		PDF::Ln();
        PDF::SetFont('helvetica', 'BI', 10); //tipo de textos y tamaño
        PDF::Ln();
        PDF::Ln();
        PDF::Output('hello_world.pdf');
		}else{
        	return redirect()->route('EntradaSalidaVehiculo.index')->with('warning','No hay parqueaderos disponibles.');
		}
        return redirect()->route('EntradaSalidaVehiculo.index')->with('success','User successfully added.');
    }
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		
	}
	public function cobro(Request $request){



		$parqueadero_vehiculo_id=$request->parqueadero_vehiculo_id;
		//->first();
		$parqueadero_vehiculo_id_dos = ParqueaderoVehiculoModel::findOrFail($parqueadero_vehiculo_id)
		->with('tipo_vehiculo_id_pk')->orderBy('id', 'DESC')->first();
		$ParqueaderoVehiculo = ParqueaderoVehiculoModel::findOrFail($parqueadero_vehiculo_id);
		$ParqueaderoVehiculo->estado_vehiculo=1;
		$ParqueaderoVehiculo->save();

		$registro=RegistroModel::where('parqueadero_vehiculo_id',$parqueadero_vehiculo_id)->first();
		$registro_id=$registro->id;
		

		$registro_edit = RegistroModel::findOrFail($registro_id);
		if ($registro->estado_vehiculo==2) {
			
		$registro_edit->estado_vehiculo=3;//3 >cobrado
		$fecha_ingreso=$registro_edit->fecha_ingreso;
		$fecha_salida=$registro_edit->fecha_salida=Carbon::now();

		$fecha1 = new DateTime($fecha_ingreso);//fecha inicial
		$fecha2 = new DateTime($fecha_salida);//fecha de cierre
		$intervalo = $fecha1->diff($fecha2);
		$dia=$intervalo->format('%d');
		$hora=$intervalo->format('%H');
		$minuto=$intervalo->format('%i');
		$tiempo_parquero=($dia*1440)+($hora*60)+$minuto;
		$registro_edit->valor_pagado=$tiempo_parquero*$parqueadero_vehiculo_id_dos->tipo_vehiculo_id_pk->precio_minutos;
		$registro_edit->precio_estacionamiento=$parqueadero_vehiculo_id_dos->tipo_vehiculo_id_pk->precio_minutos;
		$registro_edit->user_id=auth()->user()->id;	
		$registro_edit->save();
		}else{
			$fecha_ingreso=$registro_edit->fecha_ingreso;
			$fecha_salida=$registro_edit->fecha_salida;
			$fecha1 = new DateTime($fecha_ingreso);//fecha inicial
			$fecha2 = new DateTime($fecha_salida);//fecha de cierre
			$intervalo = $fecha1->diff($fecha2);
			$dia=$intervalo->format('%d');
			$hora=$intervalo->format('%H');
			$minuto=$intervalo->format('%i');
			$tiempo_parquero=($dia*1440)+($hora*60)+$minuto;
			
		}

		

		PDF::SetTitle('Resumer de barrios');
		PDF::SetFillColor(255, 255, 255);
        PDF::SetFont('times', 'BI', 20);
        //$txt = "Auditoria de SamanGir: $fecha_inicial A $fecha_final ";
        PDF::SetCreator(PDF_CREATOR);
        //PDF::SetAuthor('Nicola Asuni');
        PDF::SetTitle('TCPDF Example 029');
        PDF::SetSubject('TCPDF Tutorial');
        PDF::SetKeywords('TCPDF, PDF, example, test, guide');
        // set default header data

        PDF::SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 029', PDF_HEADER_STRING);
        //PDF::Header('/img/logo.png', 100, 'string to print as title on document header', 'string to print on document header');

        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
        PDF::SetFooterMargin(PDF_MARGIN_FOOTER);

        PDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        //PDF::setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //PDF::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        PDF::AddPage();
        PDF::SetAutoPageBreak(true, 20);
        PDF::SetFont('helvetica', 'BI', 14); //tipo de textos y tamaño

        PDF::Write(0, 'Salida de Parqueadero ', '', 0, 'C', true, 0, false, false, 0);
        PDF::Write(0, 'control de la salida de parqueadero ', '', 0, 'C', true, 0, false, false, 0);
        PDF::Ln();

        PDF::setCellPaddings(1, 1, 1, 1);
        PDF::SetFont('helvetica', 'BI', 8); //tipo de textos y tamaño
        PDF::MultiCell(80, 4, 'fecha de ingreso : ', 1, 'L', 1, 0, '', '', true, 0, false, true, 10, 'T');
        PDF::MultiCell(80, 4, $registro_edit->fecha_ingreso , 1, 'L', 1, 1, '', '', true, 0, false, true, 10, 'T');
        
        PDF::MultiCell(80, 4, 'fecha de salida : ', 1, 'L', 1, 0, '', '', true, 0, false, true, 10, 'T');
        PDF::MultiCell(80, 4, $registro_edit->fecha_salida , 1, 'L', 1, 1, '', '', true, 0, false, true, 10, 'T');
        

        PDF::MultiCell(80, 4, 'Precio de estacionamiento por minuto : ', 1, 'L', 1, 0, '', '', true, 0, false, true, 10, 'T');
        PDF::MultiCell(80, 4, $registro_edit->precio_estacionamiento, 1, 'L', 1, 1, '', '', true, 0, false, true, 10, 'T');

        PDF::MultiCell(80, 4, 'valor de parqueo : ', 1, 'L', 1, 0, '', '', true, 0, false, true, 10, 'T');
        PDF::MultiCell(80, 4, $registro_edit->valor_pagado, 1, 'L', 1, 1, '', '', true, 0, false, true, 10, 'T');

        PDF::MultiCell(80, 4, 'tiempo por minuto : ', 1, 'L', 1, 0, '', '', true, 0, false, true, 10, 'T');
        PDF::MultiCell(80, 4, $tiempo_parquero, 1, 'L', 1, 1, '', '', true, 0, false, true, 10, 'T');

       
        PDF::SetFont('helvetica', '', 8); //tipo de textos y tamaño

            $style = array(
		    'position' => '',
		    'align' => 'C',
		    'stretch' => false,
		    'fitwidth' => true,
		    'cellfitalign' => '',
		    'border' => true,
		    'hpadding' => 'auto',
		    'vpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255),
		    'text' => true,
		    'font' => 'helvetica',
		    'fontsize' => 8,
		    'stretchtext' => 4
		);
            //$code_b="$parqueadero_vehiculo_id-$registro_edit->fecha_ingreso" ;
		PDF::Cell(0, 0, $registro_id, 0, 1);
		PDF::write1DBarcode($registro_id, 'C39', '', '', '', 18, 0.4, $style, 'N');
		PDF::Ln();
		PDF::Ln();
        PDF::SetFont('helvetica', 'BI', 10); //tipo de textos y tamaño
        PDF::Ln();
        PDF::Ln();
        PDF::Output('hello_world.pdf');








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
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		
	}


	/**
	* Change resource status. ParqueaderoVehiculoModel
	*
	* @return \Illuminate\Http\Response
	*/
	public function changeStatus() 
	{
		
	}
}


