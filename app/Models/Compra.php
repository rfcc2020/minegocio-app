<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'compras';

    protected $fillable = ['proveedor_id','fecha','subtotal','descuento','iva','total','observacion','user_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detallecompra()
    {
        return $this->hasMany('App\Models\Detallecompra', 'compra_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proveedore()
    {
        return $this->hasOne('App\Models\Proveedore', 'id', 'proveedor_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
}
