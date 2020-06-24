<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;
    use OwenIt\Auditing\Contracts\Auditable;

	class campo_has_factura_has_productoModel extends Model implements Auditable {
        use \OwenIt\Auditing\Auditable;
		protected $table = 'Campo_has_Factura_has_Producto';
    protected $fillable = [];
    //public $timestamps = false;
    /*
    public function tipo_factura_id_pk(){
      return $this->belongsTo('App\Tipo_FacturaModel', 'tipo_factura_id');
    }
    public function cartera_lista_all(){
      return $this->HasMany('App\Cartera_ListaModel', 'cartera_sam_id');
    }
    */
	}