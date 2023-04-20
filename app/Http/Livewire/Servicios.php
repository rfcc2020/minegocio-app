<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Servicio;

class Servicios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $descripcion, $valor;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.servicios.view', [
            'servicios' => Servicio::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('valor', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->descripcion = null;
		$this->valor = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required|max:50',
        'descripcion' => 'nullable|max:50',
		'valor' => 'required|numeric|gt:0',
        ]);

        Servicio::create([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'valor' => $this-> valor
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Servicio Successfully created.');
    }

    public function edit($id)
    {
        $record = Servicio::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->descripcion = $record-> descripcion;
		$this->valor = $record-> valor;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|max:50',
            'descripcion' => 'nullable|max:50',
            'valor' => 'required|numeric|gt:0',
        ]);

        if ($this->selected_id) {
			$record = Servicio::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'valor' => $this-> valor
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Servicio Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Servicio::where('id', $id)->delete();
        }
    }
}