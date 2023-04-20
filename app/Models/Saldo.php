<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'saldos';

    protected $fillable = ['venta_id','valor','estado'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function venta()
    {
        return $this->hasOne('App\Models\Venta', 'id', 'venta_id');
    }
    
}
