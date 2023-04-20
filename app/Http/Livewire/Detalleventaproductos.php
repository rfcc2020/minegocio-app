<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Detalleventaproducto;
use App\Models\Venta;
use App\Models\Detalleventaservicio;
use Illuminate\Support\Facades\DB;



class Detalleventaproductos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $venta_id, $producto_id, $cantidad, $valor, $total;
    public $detalleProducto, $detalleServicio;
    public $keyWord2;

    public function render()
    {
		if ($this->keyWord == null)
            $this->keyWord=date("Y-m-d");
        if ($this->keyWord2 == null)
            $this->keyWord2=date("Y-m-d");
        return view('livewire.detalleventaproductos.view', [
            'detalleventas' => Venta::latest()
                        ->join('clientes','clientes.id','=','ventas.cliente_id')
						->whereBetween('fecha', [$this->keyWord, $this->keyWord2])
                        ->select('ventas.*', 'clientes.nombre')
						->paginate(10)
        ]);
    }
	
    public function cancel()
    {
        //$this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->venta_id = null;
		$this->producto_id = null;
		$this->cantidad = null;
		$this->valor = null;
		$this->total = null;
    }

    public function store()
    {
        $this->validate([
		'venta_id' => 'required',
		'producto_id' => 'required',
		'cantidad' => 'required',
		'valor' => 'required',
		'total' => 'required',
        ]);

        Detalleventaproducto::create([ 
			'venta_id' => $this-> venta_id,
			'producto_id' => $this-> producto_id,
			'cantidad' => $this-> cantidad,
			'valor' => $this-> valor,
			'total' => $this-> total
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Detalleventaproducto Successfully created.');
    }

    public function edit($id)
    {
        $record = Detalleventaproducto::findOrFail($id);
        $this->selected_id = $id; 
		$this->venta_id = $record-> venta_id;
		$this->producto_id = $record-> producto_id;
		$this->cantidad = $record-> cantidad;
		$this->valor = $record-> valor;
		$this->total = $record-> total;
    }

    public function update()
    {
        $this->validate([
		'venta_id' => 'required',
		'producto_id' => 'required',
		'cantidad' => 'required',
		'valor' => 'required',
		'total' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Detalleventaproducto::find($this->selected_id);
            $record->update([ 
			'venta_id' => $this-> venta_id,
			'producto_id' => $this-> producto_id,
			'cantidad' => $this-> cantidad,
			'valor' => $this-> valor,
			'total' => $this-> total
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Detalleventaproducto Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Detalleventaproducto::where('id', $id)->delete();
        }
    }

    public function consultarDetalle($idVenta){
        $this->detalleProducto = DB::table('detalleventaproductos')
                                ->join('productos','productos.id','=','detalleventaproductos.producto_id')
                                ->Where('venta_id', '=', $idVenta)
                                ->select('detalleventaproductos.*', 'productos.nombre')
                                ->get();
        $this->detalleServicio = DB::table('detalleventaservicios')
                                ->join('servicios','servicios.id','=','detalleventaservicios.servicio_id')
                                ->Where('venta_id', '=', $idVenta)
                                ->select('servicios.nombre','detalleventaservicios.*')
                                ->get();
        
    }

    public function cerrarDetalle(){
        $this->detalleProducto=null;
        $this->detalleServicio=null;
        $this->dispatchBrowserEvent('closeModal');
    }
}