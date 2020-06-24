<?php

	namespace App;


	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;

	class ZonaParqueaderoModel extends Model  implements Auditable
	{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'zona_parqueadero';
		protected $fillable = [

	    	


		];
	}

