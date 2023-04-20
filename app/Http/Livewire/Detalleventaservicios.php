<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Detalleventaservicio;

class Detalleventaservicios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $venta_id, $servicio_id, $cantidad, $valor, $total;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.detalleventaservicios.view', [
            'detalleventaservicios' => Detalleventaservicio::latest()
						->orWhere('venta_id', 'LIKE', $keyWord)
						->orWhere('servicio_id', 'LIKE', $keyWord)
						->orWhere('cantidad', 'LIKE', $keyWord)
						->orWhere('valor', 'LIKE', $keyWord)
						->orWhere('total', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->venta_id = null;
		$this->servicio_id = null;
		$this->cantidad = null;
		$this->valor = null;
		$this->total = null;
    }

    public function store()
    {
        $this->validate([
		'venta_id' => 'required',
		'servicio_id' => 'required',
		'cantidad' => 'required',
		'valor' => 'required',
		'total' => 'required',
        ]);

        Detalleventaservicio::create([ 
			'venta_id' => $this-> venta_id,
			'servicio_id' => $this-> servicio_id,
			'cantidad' => $this-> cantidad,
			'valor' => $this-> valor,
			'total' => $this-> total
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Detalleventaservicio Successfully created.');
    }

    public function edit($id)
    {
        $record = Detalleventaservicio::findOrFail($id);
        $this->selected_id = $id; 
		$this->venta_id = $record-> venta_id;
		$this->servicio_id = $record-> servicio_id;
		$this->cantidad = $record-> cantidad;
		$this->valor = $record-> valor;
		$this->total = $record-> total;
    }

    public function update()
    {
        $this->validate([
		'venta_id' => 'required',
		'servicio_id' => 'required',
		'cantidad' => 'required',
		'valor' => 'required',
		'total' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Detalleventaservicio::find($this->selected_id);
            $record->update([ 
			'venta_id' => $this-> venta_id,
			'servicio_id' => $this-> servicio_id,
			'cantidad' => $this-> cantidad,
			'valor' => $this-> valor,
			'total' => $this-> total
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Detalleventaservicio Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Detalleventaservicio::where('id', $id)->delete();
        }
    }
}