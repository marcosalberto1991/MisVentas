<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class MesaModel extends Model{
	protected $table = 'mesa';
	protected $fillable = [];
	
	public function dispositivo_id_pk() {
    	return $this->belongsTo('App\DispositivoModel', 'dispositivo_id');
	}
}
	
	