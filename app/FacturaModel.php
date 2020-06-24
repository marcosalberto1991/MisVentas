<?php
	namespace App;

	use Illuminate\Database\Eloquent\Model;
    use OwenIt\Auditing\Contracts\Auditable;

	class FacturaModel extends Model implements Auditable {
        use \OwenIt\Auditing\Auditable;
		protected $table = 'factura';
		protected $fillable = [];
	}