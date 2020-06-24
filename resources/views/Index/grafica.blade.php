@extends('layouts.app_mosnter')
<meta name="_token" content="{{ csrf_token() }}"/>


@section("content")
<section class="content">
	<div class="row">
        <div class="col-12">

        <div class="box">
            <div class="box-header">
				<h3 class="box-title">DatosDispositivo</h3>
				@can('DatosDispositivo Add')	
					<button type="button" class="btn btn-success mass-add-modal" data-toggle="modal" data-target=".bd-example-modal-lg">Añadir DatosDispositivo</button>
        		@endcan
            </div>

            <div class="box-body">


        		
        	</div>
    	</div>
    	
    		@foreach($datosdispositivo as $lists)
    		<div class="col-lg-12 col-md-12 col-sm-12 ">
    			<div class="card card-stats color-azul ">
              		<div class="card-body  ">
						<h2 style="color:#0275d8">{{$lists->dispositivo_id_pk->nombre}}</h2>
					</div>
				</div>
    		</div>	
			<div class="row">

		    	<div class="col-lg-3 col-md-6 col-sm-6">
		            <div class="card card-stats">
		              <div class="card-body ">
		                <div class="row">
		                  <div class="col-5 col-md-4">
		                    <div class="icon-big text-center icon-warning">
		                      <img src="{{asset('imagenes/water_icon-icons.com_61026.png')}}" width="120px" height="120px">
		                      <i class="nc-icon nc-globe text-warning"></i>
		                    </div>
		                  </div>
		                  <div class="col-7 col-md-8">
		                    <div class="numbers">
		                      <p class="card-category">Velocidad de la corriente</p>
		                      <p class="card-title">{{$lists->velocidad_corriente}}</p>
		                      <p class="card-category">{{$lists->temperatura}}</p>

		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		        </div>

		        <div class="col-lg-3 col-md-6 col-sm-6">
		            <div class="card card-stats">
		              <div class="card-body ">
		                <div class="row">
		                  <div class="col-5 col-md-4">
		                    <div class="icon-big text-center icon-warning">
		                      <img src="{{asset('imagenes/temperature-thermometer-.png')}}" width="120px" height="120px">
		                      <i class="nc-icon nc-globe text-warning"></i>
		                    </div>
		                  </div>
		                  <div class="col-7 col-md-8">
		                    <div class="numbers">
		                      <p class="card-category">Temperatura</p>
		                      <p class="card-title">{{$lists->temperatura}}</p>
		                      <p class="card-category">{{$lists->created_at}}</p>

		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		        </div>

		         <div class="col-lg-3 col-md-6 col-sm-6">
		            <div class="card card-stats">
		              <div class="card-body ">
		                <div class="row">
		                  <div class="col-5 col-md-4">
		                    <div class="icon-big text-center icon-warning">
		                      <img src="{{asset('imagenes/going-up.png')}}" width="120px" height="120px">
		                      <i class="nc-icon nc-globe text-warning"></i>
		                    </div>
		                  </div>
		                  <div class="col-7 col-md-8">
		                    <div class="numbers">
		                      <p class="card-category">Nivel de agua</p>
		                      <p class="card-title">{{$lists->nivel_rio}}</p>
		                      <p class="card-category">{{$lists->created_at}}</p>

		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		        </div>
    		
        	</div>
        	<br>
        	<br>

        @endforeach
              <!--
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update Now
                </div>
              </div>
          -->
    </div>
</div>
<div class="row">
    <div class="col-12">
		<div id="temperatura_grafica" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
     <div class="col-12">
		<div id="nivel_rio_grafica" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
     <div class="col-12">
		<div id="corriente_rio_grafica" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
</div>
@endsection

	
@section("page-js-files")	

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

@stop	
@section("page-js-script")		

<script type="text/javascript">
//Grafica de Temperatura
Highcharts.chart('temperatura_grafica', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Temperatura'
    },
    subtitle: {
        text: 'Datos tomados de las bollas '
    },
    xAxis: {
    	
    	categories:[
     	@foreach($fecha_dispositivo as $data)
        '{{$data['created_at']}}',
        @endforeach
        ]
        //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Junio']
    },
    yAxis: {
        title: {
            text: 'Temperatura (°C)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
    	@foreach($dispositivo as $data)
    {
        name: "{{$data['nombre']}}",
        //data:[{$data['datos_bolla']['temperatura']}}]
     	data:[
     	@foreach($data['datos_bolla'] as $bolla)
        {{$bolla['temperatura']}},
        @endforeach
        ]
        //data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
    }, 
    @endforeach
   

    ]
});
//Fin de Grafica de Temperatura

//Grafica de los niveles de los rios
Highcharts.chart('nivel_rio_grafica', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Nivel de rió'
    },
    subtitle: {
        text: 'Datos tomados de las bollas '
    },
    xAxis: {
    	
    	categories:[
     	@foreach($fecha_dispositivo as $data)
        '{{$data['created_at']}}',
        @endforeach
        ]
        //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Junio']
    },
    yAxis: {
        title: {
            text: 'Nivel de los rió'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
    	@foreach($dispositivo as $data)
    {
        name: "{{$data['nombre']}}",
        //data:[{$data['datos_bolla']['temperatura']}}]
     	data:[
     	@foreach($data['datos_bolla'] as $bolla)
        {{$bolla['nivel_rio']}},
        @endforeach
        ]
        //data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
    }, 
    @endforeach
   

    ]
});
//Fin Grafica de los niveles de los rios

//Grafica de los niveles de los rios
Highcharts.chart('corriente_rio_grafica', {
    chart: {
        type: 'line',
        plotBorderColor: '#606063'
    },
    title: {
        text: 'Corriente de los rió'
    },
    subtitle: {
        text: 'Datos tomados de las bollas '
    },
    xAxis: {
    	
    	categories:[
     	@foreach($fecha_dispositivo as $data)
        '{{$data['created_at']}}',
        @endforeach
        ]
        //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Junio']
    },
    yAxis: {
        title: {
            text: 'Corriente de los rió'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
    	@foreach($dispositivo as $data)
    {
        name: "{{$data['nombre']}}",
        //data:[{$data['datos_bolla']['temperatura']}}]
     	data:[
     	@foreach($data['datos_bolla'] as $bolla)
        {{$bolla['velocidad_corriente']}},
        @endforeach
        ]
        //data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
    }, 
    @endforeach
   

    ]
});

</script>




@stop
<style type="text/css">
	.color-azul{
		background-color: #4838f1
	}
	.card {
    border-radius: 12px;
    
    box-shadow: 10px 20px 15px -1px #6dc9e4;
    background-color: #fff;
    color: #252422;
    margin-bottom: 20px;
    position: relative;
    border: 0 none;
    transition: transform .3s cubic-bezier(.34,2,.6,1),box-shadow .2s ease;
}
.card-stats .card-body .numbers {
    text-align: right;
    font-size: 2em;
}
.card-stats .card-body .numbers .card-category {
    color: #9a9a9a;
    font-size: 16px;
    line-height: 1.4em;
}
.card-category, .category {
    text-transform: capitalize;
    font-weight: 400;
    color: #9a9a9a;
    font-size: .7142em;
}
.card-stats .card-body .numbers p {
    margin-bottom: 0;
}
.card-title {
    margin-bottom: .75rem;
}
p {
    margin-top: 0;
    margin-bottom: 1rem;
}
*, ::after, ::before {
    box-sizing: border-box;
}
user agent stylesheet
p {
    display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
}
.card-stats .card-body .numbers {
    text-align: right;
    font-size: 2em;
}
.card .numbers {
    font-size: 2em;
}
.main-panel>.content {
    padding: 0 30px 30px;
    min-height: calc(100vh - 123px);
    margin-top: 93px;
}

.card-stats .card-body {
    padding: 15px 15px 0;
}
.card .card-body {
    padding: 15px 15px 10px;
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}
*, ::after, ::before {
    box-sizing: border-box;
}
user agent stylesheet
div {
    display: block;
}
</style>

	
</body>
</html>

				
