<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Encargo;
use App\Arboles_EspeciesModel;

use App\AsistenciaModel;

use \Excel;
use Validator;
use JavaScript;
use App\Http\Requests\ExcelRequest;
//use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    protected $request;
    protected $encargo;
    protected $data = [];
    protected $i = 1;
    protected $errors;
    protected $input;
    protected $rules;

    public function __construct(Request $request, Encargo $encargo)
    {
        $this->request = $request;
        $this->encargo = $encargo;
        $this->errors = [];
        $this->data = [];
        $this->rules = [
            /*
            'albaran'       => 'required|numeric|max:9999999999',
            'codigo'       => 'required|numeric|max:9999999999',
            'id_arbol'       => 'required|numeric|max:9999999999',
            'destinatario'  => 'required|regex:/^[A-z][A-z\s\.\']+$/|max:28',
            'direccion'     => 'required|regex:/^[A-z][A-z\s\.\']+$/|max:250',
            'poblacion'     => 'required|regex:/^[A-z][A-z\s\.\']+$/|max:10',
            'cp'            => 'required|regex:/^[A-z][A-z\s\.\']+$/|min:5|max:5',
            'provincia'     => 'required|max:20',
            'telefono'      => 'required|numeric|max:9999999999',
            'observaciones' => 'max:500',
            'fecha'         => 'required|date',
            */
            'id_arbol' => 'required|numeric|max:9999999999',    
            'codigo' => 'required|min:2|max:255|regex:/^([0-9-])/',
            'nombre_comun' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',    
            'coodenadas_x' => 'required|numeric|max:9999999999',    
            'coodenadas_y' => 'required|numeric|max:9999999999',    
            'comunas' => 'required|numeric|max:5', 
            'barrio' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',  
            'espacios' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',    
            'dap' => 'required|numeric|max:50', 
            'altura_total' => 'required|numeric|max:100',    
            'diametro_mayor' => 'required|numeric|max:100',  
            'diametro_menor' => 'required|numeric|max:100',  
            'estado_arbol' => 'required|numeric|max:9999999999',    
            'estado_sanitario' => 'required|numeric|max:9999999999',    
            //'observaciones' => 'required|min:2|max:255|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',   
            'observaciones' => 'required|numeric|max:9999999999',   
            'concepto_tecnico' => 'required|numeric|max:9999999999',    
            'longitud' => 'required|numeric|max:99999999999999999999999999',    
            'lantitud' => 'required|numeric|max:99999999999999999999999999',

        ];
    }

    public function index()
    {
        return view('Excel.index');
    }

    public function tabla()
    {
        return view('registro.tabla');
    }

    public function importFile(Request $request, Encargo $encargo)
    {
        $this->processData($request);

        return view('Excel.export', [ 'data' => $this->data, 'errors' => $this->errors, 'input' => $this->input]);
    }

    /**
     * Validate cell against the rules.
     *
     * @param array $data
     * @param array $rules
     *
     * @return array
     */
    protected function validateCell(array $data, array $rules)
    {
        // Perform Validation
        $validator = \Validator::make($data, $rules);

        if ($validator->fails()) {
            $errorMessages = $validator->errors()->messages();

            // crete error message by using key and value
            foreach ($errorMessages as $key => $value) {
                $errorMessages = $value[0];
            }

            return $errorMessages;
        }

        return [];
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        if (!empty($this->errors)) {
            return view('Excel.export', [
                'data' => $this->data,
                'errors' => $this->errors,
                'input' => $this->input
            ]);
        }



        foreach ($this->data as $data) {


            //$data = array_except($data, ['id']);
            $Especies = Arboles_EspeciesModel::findOrFail($data, ['id_arbol']);
            $Especies->codigo=$data['codigo'];
            $Especies->especie_id=$data['nombre_comun'];
            $Especies->direccion=$data['coodenadas_x'];
            $Especies->barrio_id=$data['coodenadas_y'];
            $Especies->barrio_id=$data['comunas'];
            $Especies->barrio_id=$data['barrio'];
            $Especies->barrio_id=$data['espacios'];
            $Especies->barrio_id=$data['dap'];
            $Especies->barrio_id=$data['altura_total'];
            $Especies->barrio_id=$data['diametro_mayor'];
            $Especies->barrio_id=$data['diametro_menor'];
            $Especies->barrio_id=$data['estado_arbol'];
            $Especies->barrio_id=$data['estado_sanitario'];
            $Especies->barrio_id=$data['observaciones'];
            $Especies->barrio_id=$data['concepto_tecnico'];
            $Especies->barrio_id=$data['longitud'];
            $Especies->barrio_id=$data['lantitud'];
            //'nombre_comun'=>   $tre=$data['id']=$data= Arboles_EspeciesModel::select("id")->where("nombre",$row->nombre_comun)->get()->first()->toArray(),
            $Especies->save();

                   
                   




            /*
            $encargo = new Encargo;
            $encargo->albaran = $data['albaran'];
            $encargo->destinatario = $data['destinatario'];
            $encargo->direccion = $data['direccion'];
            $encargo->poblacion = $data['poblacion'];
            $encargo->cp = $data['cp'];
            $encargo->provincia = $data['provincia'];
            $encargo->telefono = $data['telefono'];
            $encargo->observaciones = $data['observaciones'];
            $encargo->fecha = $data['fecha'];
            $encargo->save();
            */
        }

        return redirect()->route('Excel')->with('info', 'Datos Guardados');
    }

    protected function processData($request){
        Excel::selectSheetsByIndex(0)->load($request->excel, function($reader) {
            
            //$reader->formatDates(true, 'd-m-Y');

            $excel = $reader->get();

            $this->errors = [];
            $this->rowNumber = 0;

            $excel->each(function($row) {

                $this->data[$this->rowNumber] = [
                    

                    'id_arbol'=>  $row->id_arbol,
                    'codigo'=>  $row->codigo,
                    //'nombre_comun'=>   $tre=$data['id']=$data= Arboles_EspeciesModel::select("id")->where("nombre",$row->nombre_comun)->get()->first()->toArray(),
                    'nombre_comun'=>  $row->nombre_comun,
                    'coodenadas_x'=>  $row->coodenadas_x,
                    'coodenadas_y'=>  $row->coodenadas_y,
                    'comunas'=>  $row->comunas,
                    'barrio'=>  $row->barrio,  
                    'espacios'=>  $row->espacios,    
                    'dap'=>  $row->dap, 
                    'altura_total'=>  $row->altura_total,    
                    'diametro_mayor'=>  $row->diametro_mayor,  
                    'diametro_menor'=>  $row->diametro_menor,  
                    'estado_arbol'=>  $row->estado_arbol,    
                    'estado_sanitario'=>  $row->estado_sanitario,    
                    'observaciones'=>  $row->observaciones,   
                    'concepto_tecnico'=>  $row->concepto_tecnico,    
                    'longitud'=>  $row->longitud,    
                    'lantitud'=>  $row->lantitud,

                    /*
                    'albaran'       => $row->albaran,
                    'destinatario'  => $row->destinatario,
                    'direccion'     => $row->direccion,
                    'poblacion'     => $row->poblacion,
                    'cp'            => $row->cp,
                    'provincia'     => $row->provincia,
                    'telefono'      => $row->telefono,
                    'observaciones' => $row->observaciones,
                    'fecha'         => $row->fecha,
                    'id_arbol'      => $row->id_arbol,
                    'codigo'        => $row->codigo,
                    */
                ];

                foreach ($this->data[$this->rowNumber] as $key => $value) {

                    $error = $this->validateCell([$key => $value], [$key => $this->rules[$key]]);

                    if (!empty($error)) {
                        $this->errors[$this->rowNumber][$key] = $error;
                    }
                    
                }

                $this->data[$this->rowNumber]['id'] = $this->rowNumber;

                $this->rowNumber++;
            });
        });
    }

    protected function validateData($request){
        $data = $request->except('_token');
        $this->errors = [];
        $this->rowNumber = 0;
        foreach ($data as $dataKey => $value) {
            $i = 0;
            foreach ($value as $item) {
                $error = $this->validateCell([$dataKey => $item], [$dataKey => $this->rules[$dataKey]]);
                if (!empty($error)) {
                    $this->errors[$i][$dataKey] = $error;
                }
                $this->data[$i]['id'] = $i;
                $this->data[$i][$dataKey] = $item;
                $i++;
            }
        }
    }
    public function export_2(){
        Excel::create('mi primer archivo',function($excel)
        {
            $excel->sheet('Sheetname',function($sheet)
            {

                $data=[];
                array_push($data,array('products->id' ,'products->asistencias_estado_id' ));

                //$products = AsistenciaModel::all();
                $products = AsistenciaModel::with('asistencias_estado_id_pk')->get();
                //var_dump($products);
                foreach ($products as $value) {
                    //$data['id']=$products->id;
                    //$data[]=$products->id;
                array_push($data,  array("$value->id" ,"$value->asistencias_estado_id_pk['nombre']" ));
                }
                //array_push($products,  array('kevin' ,'arnold' ));

                $sheet->fromArray($data);
            });    
        })->download('xlsx');
        
    }
    public function export_1(){
        if (1==3) {
            # code...
         Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $products = AsistenciaModel::all();
 
                $sheet->fromArray($products);
 
            });
        })->download('xls');
        }
        echo "string";

    }
    
}





