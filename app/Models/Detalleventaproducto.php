<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleventaproducto extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'detalleventaproductos';

    protected $fillable = ['venta_id','producto_id','cantidad','valor','total'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function venta()
    {
        return $this->hasOne('App\Models\Venta', 'id', 'venta_id');
    }
    
}
