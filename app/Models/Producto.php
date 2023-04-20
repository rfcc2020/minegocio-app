<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'productos';

    protected $fillable = ['nombre','descripcion','valor','stock','foto'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallecompras()
    {
        return $this->hasMany('App\Models\Detallecompra', 'producto_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleventaproductos()
    {
        return $this->hasMany('App\Models\Detalleventaproducto', 'producto_id', 'id');
    }
    
}
