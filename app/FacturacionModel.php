<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;
    use OwenIt\Auditing\Contracts\Auditable;

	class FacturacionModel extends Model implements Auditable {
        use \OwenIt\Auditing\Auditable;
		protected $table = 'facturacion';
    protected $fillable = [];
    //public $timestamps = false;
    
    public function proveedor_id(){
      return $this->belongsTo('App\ProveedorModel', 'proveedor_id');
    }
/*
    public function cartera_lista_all(){
      return $this->HasMany('App\Cartera_ListaModel', 'cartera_sam_id');
    }
    */
	}