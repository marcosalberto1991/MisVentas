<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;

	class CategoriaParqueaderoModel extends Model implements Auditable
	{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'categoria_parqueadero';
		protected $fillable = [
		];
		public function niveles_id_pk() {
        	return $this->belongsTo('App\NivelesModel', 'niveles_id');
    	}

	    	


	}

