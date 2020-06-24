<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class DispositivoModel extends Model
	{
		protected $table = 'dispositivo';
		protected $fillable = [
		];
		public function datos_dispositivo_bolla_all_ultimo() {
        	return $this->hasMany('App\DatosDispositivoModel', 'dispositivo_id');
    	}
    	public function datos_dispositivo_bolla_pk() {
        	return $this->belongsTo('App\DatosDispositivoModel', 'dispositivo_id');
    	}

	    	


	}
	
	