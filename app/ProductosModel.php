<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class ProductosModel extends Model
	{
		protected $table = 'productos';
		protected $fillable = [];
		//public function users_id_pk(){
		//	return $this->belongsTo('App\User', 'users_id');	}
		public function entrada_all() {
			return $this->hasMany('App\EntradaModel', 'productos_id');
		}
		public function productos_has_venta_all(){
			return $this->hasMany('App\Productos_has_ventaModel', 'productos_id');
		}

	}
	
	