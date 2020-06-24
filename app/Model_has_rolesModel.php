<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;

	class Model_has_rolesModel extends Model implements Auditable
	{

		use \OwenIt\Auditing\Auditable;
		protected $table = 'model_has_roles';
		protected $fillable = [];
		/*
		public function ventas_id_pk() {
    		return $this->belongsTo('App\VentasModel', 'ventas_id');
		}
		public function producto_id_pk() {
    		return $this->belongsTo('App\ProductoModel', 'producto_id');
		}
		*/
		
	    	


	}


