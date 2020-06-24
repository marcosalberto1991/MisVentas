<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;

	class PrecioEstacionamientosModel extends Model implements Auditable
	{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'precio_estacionamientos';
		protected $fillable = [

	    	


		];
	}


	