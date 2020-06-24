<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use OwenIt\Auditing\Contracts\Auditable;

	class PerfilUsuarioModel extends Model implements Auditable{
		use \OwenIt\Auditing\Auditable;
		protected $table = 'users_perfil';
		protected $fillable = [];
		
		//protected $primaryKey = 'users_id';
		public function municipios(){
            return $this->belongsTo('App\MunicipiosModel','municipios_id');   
        }
        public function departamento_ids(){
            return $this->belongsTo('App\DepartamentoModel','departamento_id');   
        	
        }
	}

	
	