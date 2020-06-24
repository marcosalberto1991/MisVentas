<?php
	namespace App;
	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;
	
	class AsistenciasEstadoModel extends Model implements Auditable{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'asistencias_estado';
		protected $fillable = [];
	}