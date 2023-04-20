<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'ventas';

    protected $fillable = ['cliente_id','fecha','subtotal','descuento','iva','total','pagado','saldo','observacion','user_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detalleventaproducto()
    {
        return $this->hasMany('App\Models\Detalleventaproducto', 'venta_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detalleventaservicio()
    {
        return $this->hasMany('App\Models\Detalleventaservicio', 'venta_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saldos()
    {
        return $this->hasOne('App\Models\Saldo', 'venta_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
}
