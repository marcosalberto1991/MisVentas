<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;
    use OwenIt\Auditing\Contracts\Auditable;

	class VentasModel extends Model implements Auditable {
        use \OwenIt\Auditing\Auditable;
		protected $table = 'ventas';
    protected $fillable = [];
    //public $timestamps = false;
    
    public function mesa_id(){
      return $this->belongsTo('App\MesaModel', 'mesa_id');
    }
    public function estado_id(){
      return $this->belongsTo('App\EstadoModel', 'estado_id');
    }
    public function mesa_id_pk() {
      return $this->belongsTo('App\MesaModel', 'mesa_id');
    }
    public function ventas_has_producto_all() {
      return $this->hasMany('App\Ventas_has_productoModel', 'ventas_id');
    }
    public function ventas_has_producto_all_ventas() {
      return $this->hasMany('App\Ventas_has_productoModel', 'ventas_id')
      //->select('cantidad')
      ;
    }
    /*
    public function tipo_factura_id_pk(){
      return $this->belongsTo('App\Tipo_FacturaModel', 'tipo_factura_id');
    }
    public function cartera_lista_all(){
      return $this->HasMany('App\Cartera_ListaModel', 'cartera_sam_id');
    }
    */
	}