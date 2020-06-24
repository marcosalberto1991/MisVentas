<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EstadoModel extends Model implements Auditable {
    use \OwenIt\Auditing\Auditable;
    protected $table    = 'estado';
    protected $fillable = [];

}
