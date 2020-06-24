<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	use OwenIt\Auditing\Contracts\Auditable;
	class RegistroModel extends Model implements Auditable
	{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'registro';
		protected $fillable = [

	    	


		];
	}

