<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Compra;
use App\Models\Proveedore;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Models\Detallecompra;
class Compras extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $proveedor_id, $fecha, $subtotal, $descuento, $iva, $total, $observacion, $user_id;
	public $detalleCompra;
	public $producto_id, $cantidad, $valor, $totalProducto;

    public function render()
    {
		if(!isset($this->fecha))
			$this->fecha=date("Y-m-d");
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.compras.view', [
            'compras' => Compra::latest()
						->orWhere('proveedor_id', 'LIKE', $keyWord)
						->orWhere('fecha', 'LIKE', $keyWord)
						->orWhere('subtotal', 'LIKE', $keyWord)
						->orWhere('descuento', 'LIKE', $keyWord)
						->orWhere('iva', 'LIKE', $keyWord)
						->orWhere('total', 'LIKE', $keyWord)
						->orWhere('observacion', 'LIKE', $keyWord)
						->orWhere('user_id', 'LIKE', $keyWord)
						->paginate(10),
			'proveedores' => Proveedore::select('id','nombre')->orderBy('nombre')->get(),
			'productos' => Producto::select('id','nombre')->orderBy('nombre')->get(),
        ]);
    }
	
    public function cancel()
    {
        
    }
	
    private function resetInput()
    {		
		$this->proveedor_id = null;
		$this->fecha = null;
		$this->subtotal = null;
		$this->descuento = null;
		$this->iva = null;
		$this->total = null;
		$this->observacion = null;
		$this->user_id = null;
		$this->detalleCompra=null;
    }

	private function resetProducto()
    {		
		$this->producto_id = null;
		$this->cantidad = null;
		$this->valor = null;
		$this->totalProducto = null;
    }

	public function addProducto(){
		if(!isset($this->detalleCompra[$this->producto_id])){
		$this->validate([
			'producto_id' => 'required|gt:0',
			'cantidad' => 'required|numeric|gt:0',
			'valor' => 'required|numeric|gt:0',
			]);
		if($this->producto_id>0 && $this->cantidad > 0 && $this->valor > 0){
		
		$record = Producto::find($this->producto_id);
			
		$this->totalProducto=$this->cantidad*$this->valor;
			$this->detalleCompra[$this->producto_id]= array(
				'producto_id'=>$this->producto_id,
				'nombre'=>$record->nombre,'cantidad'=>$this->cantidad,
				'valor'=>$this->valor,
				'total'=>$this->totalProducto
			);

		//dd($this->detalleCompra);
		
		$this->subtotal=$this->subtotal+$this->totalProducto;
		$this->descuento=0;
		$this->iva=($this->subtotal-$this->descuento)*0.12;
		$this->total=$this->subtotal-$this->descuento+$this->iva;		
		$this->resetProducto();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Compra Successfully created.');}
		else
		{
			session()->flash('message', 'Compra no se permite repetir el prod.');
		}
	}else
		session()->flash('message', 'Los datos deben ser positivos .');

	}

	public function guardarCompra(){
		$this->validate([
			'proveedor_id' => 'required|gt:0',
			'fecha' => 'required|date',
			'subtotal' => 'required|numeric|gt:0',
			'descuento' => 'required|numeric|gte:0',
			'iva' => 'required|numeric|gte:0',
			'total' => 'required|numeric|gt:0',
			]);
		if(isset($this->detalleCompra) && count($this->detalleCompra) > 0 && $this->proveedor_id > 0){
			$correcto=false;
			DB::beginTransaction();
			$compra  = new Compra();
			$compra->proveedor_id=$this-> proveedor_id;
			$compra->fecha=$this-> fecha;
			$compra->subtotal=$this-> subtotal;
			$compra->descuento= $this-> descuento;
			$compra->iva=$this-> iva;
			$compra->total=$this-> total;
			$compra->observacion=$this-> observacion;
			$compra->user_id=auth()->id();
			$compra->save();

			foreach($this->detalleCompra as $dc){
				Detallecompra::create([ 
					'compra_id' => $compra->id,
					'producto_id' => $dc['producto_id'],
					'cantidad' => $dc['cantidad'],
					'valor' => $dc['valor'],
					'total' => $dc['total']
				]);
					$record = Producto::find($dc['producto_id']);
					$record->update([ 
					'stock' => $record->stock+$dc['cantidad'],
					'valor' => $dc['valor']
					]);	
			}		

			$this->resetInput();
			$this->resetProducto();
			$correcto=true;
			if($correcto){
				DB::commit();
				session()->flash('message', 'Compra Successfully created.');
			}
			else{
				DB::rollback();
				session()->flash('message', 'Compra no created por error');
			}

		}
		
	}

    public function store()
    {
        $this->validate([
		'proveedor_id' => 'required',
		'fecha' => 'required',
		'subtotal' => 'required',
		'descuento' => 'required',
		'iva' => 'required',
		'total' => 'required',
		'user_id' => 'required',
        ]);

        Compra::create([ 
			'proveedor_id' => $this-> proveedor_id,
			'fecha' => $this-> fecha,
			'subtotal' => $this-> subtotal,
			'descuento' => $this-> descuento,
			'iva' => $this-> iva,
			'total' => $this-> total,
			'observacion' => $this-> observacion,
			'user_id' => $this-> user_id
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Compra Successfully created.');
    }

    public function edit($id)
    {
        $record = Compra::findOrFail($id);
        $this->selected_id = $id; 
		$this->proveedor_id = $record-> proveedor_id;
		$this->fecha = $record-> fecha;
		$this->subtotal = $record-> subtotal;
		$this->descuento = $record-> descuento;
		$this->iva = $record-> iva;
		$this->total = $record-> total;
		$this->observacion = $record-> observacion;
		$this->user_id = $record-> user_id;
    }

    public function update()
    {
        $this->validate([
		'proveedor_id' => 'required',
		'fecha' => 'required',
		'subtotal' => 'required',
		'descuento' => 'required',
		'iva' => 'required',
		'total' => 'required',
		'user_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Compra::find($this->selected_id);
            $record->update([ 
			'proveedor_id' => $this-> proveedor_id,
			'fecha' => $this-> fecha,
			'subtotal' => $this-> subtotal,
			'descuento' => $this-> descuento,
			'iva' => $this-> iva,
			'total' => $this-> total,
			'observacion' => $this-> observacion,
			'user_id' => $this-> user_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Compra Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Compra::where('id', $id)->delete();
        }
    }
	public function quitarProductoDetalle($id){

		$this->subtotal=$this->subtotal-$this->detalleCompra[$id]['total'];
		$this->descuento=0;
		$this->iva=($this->subtotal-$this->descuento)*0.12;
		$this->total=$this->subtotal-$this->descuento+$this->iva;			
		unset($this->detalleCompra[$id]);
	}
}