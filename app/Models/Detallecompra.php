<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallecompra extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'detallecompras';

    protected $fillable = ['compra_id','producto_id','cantidad','valor','total'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function compra()
    {
        return $this->hasOne('App\Models\Compra', 'id', 'compra_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
    }
    
}
