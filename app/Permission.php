<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;

	class Permission extends Model implements Auditable{
		use \OwenIt\Auditing\Auditable;
		//protected $table = 'estado_proceso';
		protected $fillable = [];
		
	}
	