<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'proveedores';

    protected $fillable = ['cedula','nombre','direccion','telefono','email','foto'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function compras()
    {
        return $this->hasMany('App\Models\Compra', 'proveedor_id', 'id');
    }
    
}
