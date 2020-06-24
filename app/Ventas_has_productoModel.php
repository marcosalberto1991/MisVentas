<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;

	class Ventas_has_productoModel extends Model implements Auditable
	{

		use \OwenIt\Auditing\Auditable;
		protected $table = 'ventas_has_producto';
		protected $fillable = [];

		public function ventas_id_pk() {
    		return $this->belongsTo('App\VentasModel', 'ventas_id');
		}
		public function producto_id_pk() {
    		return $this->belongsTo('App\ProductoModel', 'producto_id');
		}
		public function producto_id() {
    		return $this->belongsTo('App\ProductoModel', 'producto_id');
		}
		
		
	    	


	}


