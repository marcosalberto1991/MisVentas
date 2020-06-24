<?php

	namespace App;
	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;


	class TipoVehiculoModel extends Model implements Auditable
	{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'tipo_vehiculo';
		protected $fillable = [
		];

		
		public function parqueadero_vehiculo_all() {
        	return $this->hasMany('App\ParqueaderoVehiculoModel', 'tipo_vehiculo_id');
    	}

	    	


	}

