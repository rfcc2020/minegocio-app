<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'servicios';

    protected $fillable = ['nombre','descripcion','valor'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleventaservicios()
    {
        return $this->hasMany('App\Models\Detalleventaservicio', 'servicio_id', 'id');
    }
    
}
