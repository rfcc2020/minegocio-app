<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'clientes';

    protected $fillable = ['cedula','nombre','apellido','direccion','telefono','email','foto'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventas()
    {
        return $this->hasMany('App\Models\Venta', 'cliente_id', 'id');
    }

    public function getFotoAttribute($foto){
        if(file_exists('storage/'.$foto)){
            return $foto;
        }else{
            return 'sinfoto.jpg';
        }
    }
    
}
