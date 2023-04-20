<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleventaservicio extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'detalleventaservicios';

    protected $fillable = ['venta_id','servicio_id','cantidad','valor','total'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function servicio()
    {
        return $this->hasOne('App\Models\Servicio', 'id', 'servicio_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function venta()
    {
        return $this->hasOne('App\Models\Venta', 'id', 'venta_id');
    }
    
}
