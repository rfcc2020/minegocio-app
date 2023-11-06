<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\Saldo;
use App\Models\Detalleventa;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use App\Models\Detalleventaproducto;
use App\Models\Detalleventaservicio;

class Ventas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $cliente_id, $fecha, $subtotal, $descuento, $iva, $total, $pagado, $saldo, $observacion, $user_id;
	public $detalleProducto;
	public $producto_id, $cantidadProducto, $valorProducto, $totalProducto, $precioProducto, $stockProducto, $precioSugeridoProducto;
	public $detalleServicio;
	public $servicio_id, $cantidadServicio, $valorServicio, $totalServicio;
	public $saldoAnterior, $cambio;
	public $idSaldo;

    public function render()
    {
		if(!isset($this->fecha))
			$this->fecha=date("Y-m-d");
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.ventas.view', [
            'ventas' => Venta::latest()
						->orWhere('cliente_id', 'LIKE', $keyWord)
						->orWhere('fecha', 'LIKE', $keyWord)
						->orWhere('subtotal', 'LIKE', $keyWord)
						->orWhere('descuento', 'LIKE', $keyWord)
						->orWhere('iva', 'LIKE', $keyWord)
						->orWhere('total', 'LIKE', $keyWord)
						->orWhere('pagado', 'LIKE', $keyWord)
						->orWhere('saldo', 'LIKE', $keyWord)
						->orWhere('observacion', 'LIKE', $keyWord)
						->orWhere('user_id', 'LIKE', $keyWord)
						->paginate(10),
			'clientes' => Cliente::select('id','nombre','apellido')->orderBy('nombre')->get(),
			'productos' => Producto::select('id','nombre')->orderBy('nombre')->get(),
			'servicios' => Servicio::select('id','nombre')->orderBy('nombre')->get(),
			'saldos' => Saldo::select('id','venta_id','valor','estado')->get(),
        ]);
    }
	
    public function cancelProducto()
    {
        $this->resetProducto();
    }

	public function cancelServicio()
    {
        $this->resetServicio();
    }
	
    private function resetInput()
    {		
		$this->cliente_id = null;
		$this->fecha = null;
		$this->subtotal = null;
		$this->descuento = null;
		$this->iva = null;
		$this->total = null;
		$this->pagado = null;
		$this->saldo = null;
		$this->observacion = null;
		$this->saldoAnterior = null;
		$this->user_id = null;
		$this->detalleProducto = null;
		$this->detalleServicio = null;
		$this->cambio=null;
    }

	private function resetProducto()
    {		
		$this->producto_id = null;
		$this->cantidadProducto = null;
		$this->valorProducto = null;
		$this->totalProducto = null;
    }

	private function resetServicio()
    {		
		$this->servicio_id = null;
		$this->cantidadServicio = null;
		$this->valorServicio = null;
		$this->totalServicio = null;
    }

	public function addProducto(){
		if(!isset($this->detalleProducto[$this->producto_id])){
		$this->validate([
			'producto_id' => 'required|gt:0|numeric',
			'cantidadProducto' => 'required|numeric|gt:0',
			'valorProducto' => 'required|numeric|gt:0',
			]);
		if($this->producto_id>0 && $this->cantidadProducto > 0 && $this->valorProducto > 0 && $this->cantidadProducto <= $this->stockProducto){
			
		$record = Producto::find($this->producto_id);
			
		$this->totalProducto=$this->cantidadProducto*$this->valorProducto;
			$this->detalleProducto[$this->producto_id]= array(
				'producto_id'=>$this->producto_id,
				'nombre'=>$record->nombre,'cantidad'=>$this->cantidadProducto,
				'valor'=>$this->valorProducto,
				'total'=>$this->totalProducto
			);

		$this->subtotal=round($this->subtotal+$this->totalProducto,2,PHP_ROUND_HALF_UP);
		$this->descuento=0;
		$this->iva=($this->subtotal-$this->descuento)*0;//0.12;
		$this->actualizaTotales();
		$this->actualizaCambio();		
		$this->resetProducto();
		$this->resetValoresProducto();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Agregado Successfully.');}
		else
		{
			session()->flash('message', 'Venta no se permite repetir el prod.');
		}
	}else
		session()->flash('message', 'Los datos deben ser positivos .');

	}

	public function addServicio(){
		
		if(!isset($this->detalleServicio[$this->servicio_id])){
		$this->validate([
			'servicio_id' => 'required:gt:0',
			'cantidadServicio' => 'required|numeric|gt:0',
			'valorServicio' => 'required|numeric|gt:0',
			]);
		
		
		
		if($this->servicio_id>0 && $this->cantidadServicio > 0 && $this->valorServicio > 0){
		$record = Servicio::find($this->servicio_id);
			
		$this->totalServicio=$this->cantidadServicio*$this->valorServicio;
		
			$this->detalleServicio[$this->servicio_id]= array(
				'servicio_id'=>$this->servicio_id,
				'nombre'=>$record->nombre,'cantidad'=>$this->cantidadServicio,
				'valor'=>$this->valorServicio,
				'total'=>$this->totalServicio
			);

		//dd($this->detalleCompra);
		
		$this->subtotal=round($this->subtotal+$this->totalServicio,2,PHP_ROUND_HALF_UP);
		$this->descuento=0;
		$this->iva=($this->subtotal-$this->descuento)*0;
		$this->actualizaTotales();
		$this->actualizaCambio();
		$this->resetServicio();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Servicio Successfully added.');}
		else
		{
			session()->flash('message', 'Los datos deben ser positivos');
		}
	}else
		session()->flash('message', 'Servicio no se permite repetir el serv..');
		
	}

	public function guardarVenta(){
		$this->validate([
			'cliente_id' => 'required|gt:0',
			'fecha' => 'required',
			'subtotal' => 'required|numeric|gt:0',
			'descuento' => 'required|numeric|gte:0',
			'iva' => 'required|numeric|gte:0',
			'total' => 'required|numeric|gt:0',
			'pagado' => 'required|numeric|gte:0',
			'saldo' => 'required|numeric|gte:0',
			]);
		if(((isset($this->detalleProducto) && count($this->detalleProducto) > 0) || (isset($this->detalleServicio) && count($this->detalleServicio) > 0)) && $this->cliente_id > 0){
			if($this->saldo==0){
				$this->pagado=$this->total;
			}
			$correcto=false;
			DB::beginTransaction();
			$venta  = new Venta();
			$venta->cliente_id=$this-> cliente_id;
			$venta->fecha=$this-> fecha;
			$venta->subtotal=$this-> subtotal;
			$venta->descuento= $this-> descuento;
			$venta->iva=$this-> iva;
			$venta->total=$this-> total;
			$venta->pagado=$this-> pagado;
			$venta->saldo=$this-> saldo;
			$venta->observacion=$this-> observacion;
			$venta->user_id=auth()->id();
			$venta->save();
			if($this->detalleProducto != null)
			foreach($this->detalleProducto as $dp){
				Detalleventaproducto::create([ 
					'venta_id' => $venta->id,
					'producto_id' => $dp['producto_id'],
					'cantidad' => $dp['cantidad'],
					'valor' => $dp['valor'],
					'total' => $dp['total']
				]);
					$record = Producto::find($dp['producto_id']);
					$record->update([ 
					'stock' => $record->stock-$dp['cantidad']
					]);	
			}	
			if($this->detalleServicio != null)
			foreach($this->detalleServicio as $ds){
				Detalleventaservicio::create([ 
					'venta_id' => $venta->id,
					'servicio_id' => $ds['servicio_id'],
					'cantidad' => $ds['cantidad'],
					'valor' => $ds['valor'],
					'total' => $ds['total']
				]);
			}

			if($this->idSaldo > 0){
				$record = Saldo::find($this->idSaldo);
				$record->update([ 
					'estado' => 'pagado'
				]);	
			}
			
			if($this->saldo > 0){
				Saldo::create([ 
					'venta_id' => $venta->id,
					'valor' => $this-> saldo,
					'estado' => 'pendiente'
				]);
			}

			$this->resetInput();
			$this->resetProducto();
			$this->resetServicio();
			$correcto=true;
			if($correcto){
				DB::commit();
				session()->flash('message', 'Venta Successfully created.');
			}
			else{
				DB::rollback();
				session()->flash('message', 'Venta no created por error');
			}

		}
		
	}

    public function store()
    {
        $this->validate([
		'cliente_id' => 'required',
		'fecha' => 'required',
		'subtotal' => 'required',
		'descuento' => 'required',
		'iva' => 'required',
		'total' => 'required',
		'pagado' => 'required',
		'saldo' => 'required',
		'user_id' => 'required',
        ]);

        Venta::create([ 
			'cliente_id' => $this-> cliente_id,
			'fecha' => $this-> fecha,
			'subtotal' => $this-> subtotal,
			'descuento' => $this-> descuento,
			'iva' => $this-> iva,
			'total' => $this-> total,
			'pagado' => $this-> pagado,
			'saldo' => $this-> saldo,
			'observacion' => $this-> observacion,
			'user_id' => $this-> user_id
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Venta Successfully created.');
    }

    public function edit($id)
    {
        $record = Venta::findOrFail($id);
        $this->selected_id = $id; 
		$this->cliente_id = $record-> cliente_id;
		$this->fecha = $record-> fecha;
		$this->subtotal = $record-> subtotal;
		$this->descuento = $record-> descuento;
		$this->iva = $record-> iva;
		$this->total = $record-> total;
		$this->pagado = $record-> pagado;
		$this->saldo = $record-> saldo;
		$this->observacion = $record-> observacion;
		$this->user_id = $record-> user_id;
    }

    public function update()
    {
        $this->validate([
		'cliente_id' => 'required',
		'fecha' => 'required',
		'subtotal' => 'required',
		'descuento' => 'required',
		'iva' => 'required',
		'total' => 'required',
		'pagado' => 'required',
		'saldo' => 'required',
		'user_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Venta::find($this->selected_id);
            $record->update([ 
			'cliente_id' => $this-> cliente_id,
			'fecha' => $this-> fecha,
			'subtotal' => $this-> subtotal,
			'descuento' => $this-> descuento,
			'iva' => $this-> iva,
			'total' => $this-> total,
			'pagado' => $this-> pagado,
			'saldo' => $this-> saldo,
			'observacion' => $this-> observacion,
			'user_id' => $this-> user_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Venta Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Venta::where('id', $id)->delete();
        }
    }
	public function quitarProducto($id){

		$this->subtotal=$this->subtotal-$this->detalleProducto[$id]['total'];
		$this->descuento=0;
		$this->iva=($this->subtotal-$this->descuento)*0;
		$this->actualizaTotales();
		$this->actualizaCambio();			
		unset($this->detalleProducto[$id]);
	}
	public function quitarServicio($id){

		$this->subtotal=$this->subtotal-$this->detalleServicio[$id]['total'];
		$this->descuento=0;
		$this->iva=($this->subtotal-$this->descuento)*0;
		$this->actualizaTotales();
		$this->actualizaCambio();		
		unset($this->detalleServicio[$id]);
	}

	public function buscarSaldoCliente($idCliente){
		dd($idCliente);
		
	}

	public function updatedClienteId($value){
		if($value > 0){
		$this->saldoAnterior = DB::table('saldos')
                        ->join('ventas','ventas.id','=','saldos.venta_id')
						->join('clientes','clientes.id','=','ventas.cliente_id')
						->Where('clientes.id', '=', $value)
						->Where('saldos.estado','=','pendiente')
                        ->select('saldos.valor as valor')
						->value('valor');
		if ($this->saldoAnterior == null){
			$this->saldoAnterior=0;
			$this->idSaldo=0;
		}else{
			$this->idSaldo = DB::table('saldos')
                        ->join('ventas','ventas.id','=','saldos.venta_id')
						->join('clientes','clientes.id','=','ventas.cliente_id')
						->Where('clientes.id', '=', $value)
						->Where('saldos.estado','=','pendiente')
                        ->select('saldos.id as id')
						->value('id');
						$this->actualizaTotales();	
		}

	}		
		else{
				$this->saldoAnterior=0;
				$this->actualizaTotales();
		}
	}

	public function updatedPagado(){
		$this->actualizaCambio();
	}

	private function actualizaTotales(){
		$this->total=$this->subtotal-$this->descuento+$this->iva+$this->saldoAnterior;
	}

	private function actualizaCambio(){

		try{
			if(!is_numeric($this->pagado))
				$valPagado=0;
			else
				$valPagado=$this->pagado;
			$cambio = round($valPagado-$this->total,2,PHP_ROUND_HALF_UP);
		if($cambio >= 0){
			$this->cambio=$cambio;
			$this->saldo=0;
		}else{
			$this->cambio=0;
			$this->saldo=$cambio*-1;
		}
		}catch(Throwable $e){
			report($e);
		}
	}

	public function updatedProductoId(){
		if(isset($this->producto_id) &&  $this->producto_id > 0){
			$record = Producto::find($this->producto_id);
			if($record != null){
				$this->precioProducto=$record->valor;
				$this->stockProducto=$record->stock;
				$this->precioSugeridoProducto=round($this->precioProducto*1.25,2,PHP_ROUND_HALF_UP);
			}
			else{
				$this->resetValoresProducto();
			}
		}
		else{
			$this->resetValoresProducto();
		}
	}

	public function updatedServicioId(){
		if(isset($this->servicio_id) &&  $this->servicio_id > 0){
			$record = Servicio::find($this->servicio_id);
			if($record != null){
				$this->valorServicio=$record->valor;
			}
			else{
				$this->valorServicio=null;
			}
		}
		else{
			$this->valorServicio=null;
		}
	}

	public function resetValoresProducto(){
		$this->precioProducto=null;
		$this->stockProducto=null;
		$this->precioSugeridoProducto=null;
	}
}