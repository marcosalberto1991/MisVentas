<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;

	class punto extends Model implements Auditable
	{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'punto';
		protected $fillable = [

	    	


		];
	}


	