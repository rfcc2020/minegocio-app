<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use Livewire\WithFileUploads;


class Productos extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $descripcion, $valor, $stock, $foto;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.productos.view', [
            'productos' => Producto::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('valor', 'LIKE', $keyWord)
						->orWhere('stock', 'LIKE', $keyWord)
						->orWhere('foto', 'LIKE', $keyWord)
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
		$this->stock = null;
		$this->foto = null;
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|max:100',
            'valor' => 'required|numeric|gt:0',
            'descripcion' => 'nullable|max:100',
            'stock' => 'required|numeric|gte:0',
        ]);

        Producto::create([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'valor' => $this-> valor,
			'stock' => $this-> stock,
			'foto' => $this-> foto
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Producto Successfully created.');
    }

    public function edit($id)
    {
        $record = Producto::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->descripcion = $record-> descripcion;
		$this->valor = $record-> valor;
		$this->stock = $record-> stock;
		$this->foto = $record-> foto;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required|max:100',
		'valor' => 'required|numeric|gt:0',
        'descripcion' => 'nullable|max:100',
        'stock' => 'required|numeric|gte:0',
        ]);

        if ($this->selected_id) {
			$record = Producto::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'valor' => $this-> valor,
			'stock' => $this-> stock
            ]);

            if(isset($this->foto) && is_file($this->foto) && $record->foto != $this->foto){
				$record->update([ 
					'foto'=>$this->foto->store('imgproductos','public')
				]);
            }

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Producto Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Producto::where('id', $id)->delete();
        }
    }
}