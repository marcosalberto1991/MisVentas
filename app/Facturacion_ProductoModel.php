<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;
    use OwenIt\Auditing\Contracts\Auditable;

	class Facturacion_ProductoModel extends Model implements Auditable {
        use \OwenIt\Auditing\Auditable;
		protected $table = 'facturacion_has_producto';
    protected $fillable = [];
    public $timestamps = false;
    
    public function producto_id(){
      return $this->belongsTo('App\ProductoModel', 'producto_id');
    }
    
    public function campo_has_factura_has_producto(){
      return $this->HasMany('App\Campo_has_Factura_has_ProductoModel', 'factura_has_producto_id');
    }
    
	}