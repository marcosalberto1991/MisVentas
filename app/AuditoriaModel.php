<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class AuditoriaModel extends Model{
		protected $table = 'audits';
		protected $fillable = [];

 		public function user_id_pk(){
            return $this->belongsTo('App\User','user_id');   
        }
	    	


	}
	
	