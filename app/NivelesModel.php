<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;

	class NivelesModel extends Model implements Auditable
	{

		use \OwenIt\Auditing\Auditable;
		protected $table = 'niveles';
		protected $fillable = [

	    	


		];
	}


