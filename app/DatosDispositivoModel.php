<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class DatosDispositivoModel extends Model{
	protected $table = 'datos_dispositivo_bolla';
	protected $fillable = [];
	
	public function dispositivo_id_pk() {
    	return $this->belongsTo('App\DispositivoModel', 'dispositivo_id');
	}
}
	
	