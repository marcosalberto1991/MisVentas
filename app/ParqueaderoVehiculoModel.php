<?php

	namespace App;
	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;


	class ParqueaderoVehiculoModel extends Model implements Auditable
	{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'parqueadero_vehiculo';
		protected $fillable = [
		];
		public function registro_id_pk() {
        	return $this->belongsTo('App\RegistroModel', 'registro_id');
    	}
    	public function registro_all() {
        	return $this->HasMany('App\RegistroModel', 'parqueadero_vehiculo_id');
    	}
    	public function tipo_vehiculo_id_pk() {
        	return $this->belongsTo('App\TipoVehiculoModel', 'tipo_vehiculo_id');
    	}

	    	


	}



	
	
	