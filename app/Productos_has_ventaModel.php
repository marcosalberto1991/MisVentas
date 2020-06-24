<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Productos_has_ventaModel extends Model
	{
		protected $table = 'productos_has_venta';
		protected $fillable = [];

		public function venta_id_pk() {
        	return $this->belongsTo('App\VentaModel', 'venta_id');
		}
		public function producto_id_pk() {
        	return $this->belongsTo('App\ProductosModel', 'productos_id');
		}
		

	}
	
	