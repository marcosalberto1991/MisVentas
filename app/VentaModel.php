<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class VentaModel extends Model
	{
		protected $table = 'venta';
		protected $fillable = [];

		public function productos_has_venta_all() {
			return $this->hasMany('App\Productos_has_ventaModel', 'venta_id');
		}
		public function users_id_pk(){
			return $this->belongsTo('App\User', 'users_id');
		}
		
		
	}
	
	