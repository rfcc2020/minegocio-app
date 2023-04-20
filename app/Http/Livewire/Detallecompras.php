<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Detallecompra;
use App\Models\Compra;
use Illuminate\Support\Facades\DB;

class Detallecompras extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $compra_id, $producto_id, $cantidad, $valor, $total;
    public $detalleProducto;
    public $keyWord2;

    public function render()
    {
        if ($this->keyWord == null)
            $this->keyWord=date("Y-m-d");
        if ($this->keyWord2 == null)
            $this->keyWord2=date("Y-m-d");
        return view('livewire.detallecompras.view', [
            'detallecompras' => Compra::latest()
                        ->join('proveedores','proveedores.id','=','compras.proveedor_id')
						->whereBetween('fecha', [$this->keyWord, $this->keyWord2])
                        ->select('compras.*', 'proveedores.nombre as proveedor')
						->paginate(10)
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->compra_id = null;
		$this->producto_id = null;
		$this->cantidad = null;
		$this->valor = null;
		$this->total = null;
    }

    public function store()
    {
        $this->validate([
		'compra_id' => 'required',
		'producto_id' => 'required',
		'cantidad' => 'required',
		'valor' => 'required',
		'total' => 'required',
        ]);

        Detallecompra::create([ 
			'compra_id' => $this-> compra_id,
			'producto_id' => $this-> producto_id,
			'cantidad' => $this-> cantidad,
			'valor' => $this-> valor,
			'total' => $this-> total
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Detallecompra Successfully created.');
    }

    public function edit($id)
    {
        $record = Detallecompra::findOrFail($id);
        $this->selected_id = $id; 
		$this->compra_id = $record-> compra_id;
		$this->producto_id = $record-> producto_id;
		$this->cantidad = $record-> cantidad;
		$this->valor = $record-> valor;
		$this->total = $record-> total;
    }

    public function update()
    {
        $this->validate([
		'compra_id' => 'required',
		'producto_id' => 'required',
		'cantidad' => 'required',
		'valor' => 'required',
		'total' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Detallecompra::find($this->selected_id);
            $record->update([ 
			'compra_id' => $this-> compra_id,
			'producto_id' => $this-> producto_id,
			'cantidad' => $this-> cantidad,
			'valor' => $this-> valor,
			'total' => $this-> total
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Detallecompra Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Detallecompra::where('id', $id)->delete();
        }
    }

    public function consultarDetalle($idVenta){
        $this->detalleProducto = DB::table('detallecompras')
                                ->join('productos','productos.id','=','detallecompras.producto_id')
                                ->Where('compra_id', '=', $idVenta)
                                ->select('detallecompras.*', 'productos.nombre')
                                ->get();
        
    }

    public function cerrarDetalle(){
        $this->detalleProducto=null;
        $this->dispatchBrowserEvent('closeModal');
    }
}