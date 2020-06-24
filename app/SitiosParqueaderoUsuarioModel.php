<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	use OwenIt\Auditing\Contracts\Auditable;
	class SitiosParqueaderoUsuarioModel extends Model implements Auditable
	{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'sitios_parqueadero_has_user';
		protected $fillable = [

	    	


		];
	}


