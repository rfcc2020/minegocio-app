<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Saldo;

class Saldos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $venta_id, $valor, $estado;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.saldos.view', [
            'saldos' => Saldo::latest('estado')
                        ->join('ventas','ventas.id','=','saldos.venta_id')
                        ->join('clientes','clientes.id','=','ventas.cliente_id')
						->orWhere('venta_id', 'LIKE', $keyWord)
						->orWhere('valor', 'LIKE', $keyWord)
						->orWhere('estado', 'LIKE', $keyWord)
                        ->select('saldos.*','clientes.nombre','clientes.apellido')
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
		$this->valor = null;
		$this->estado = null;
    }

    public function store()
    {
        $this->validate([
		'venta_id' => 'required',
		'valor' => 'required',
		'estado' => 'required',
        ]);

        Saldo::create([ 
			'venta_id' => $this-> venta_id,
			'valor' => $this-> valor,
			'estado' => $this-> estado
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Saldo Successfully created.');
    }

    public function edit($id)
    {
        $record = Saldo::findOrFail($id);
        $this->selected_id = $id; 
		$this->venta_id = $record-> venta_id;
		$this->valor = $record-> valor;
		$this->estado = $record-> estado;
    }

    public function update()
    {
        $this->validate([
		'venta_id' => 'required',
		'valor' => 'required',
		'estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Saldo::find($this->selected_id);
            $record->update([ 
			'venta_id' => $this-> venta_id,
			'valor' => $this-> valor,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Saldo Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Saldo::where('id', $id)->delete();
        }
    }
}