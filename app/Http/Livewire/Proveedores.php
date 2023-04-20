<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proveedore;
use Livewire\WithFileUploads;


class Proveedores extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $cedula, $nombre, $direccion, $telefono, $email, $foto;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.proveedores.view', [
            'proveedores' => Proveedore::latest()
						->orWhere('cedula', 'LIKE', $keyWord)
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
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
		$this->cedula = null;
		$this->nombre = null;
		$this->direccion = null;
		$this->telefono = null;
		$this->email = null;
		$this->foto = null;
    }

    public function store()
    {
        $this->validate([
            'cedula' => 'nullable|min:10|max:13|unique:proveedores',
			'telefono' => 'nullable|max:10',
			'email' => 'nullable|email',
			'direccion' => 'nullable|max:50',
			'nombre' => 'required|max:50',
			'foto' => 'nullable|max:200'
        ]);

        Proveedore::create([ 
			'cedula' => $this-> cedula,
			'nombre' => $this-> nombre,
			'direccion' => $this-> direccion,
			'telefono' => $this-> telefono,
			'email' => $this-> email,
			'foto' => $this-> foto
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Proveedore Successfully created.');
    }

    public function edit($id)
    {
        $record = Proveedore::findOrFail($id);
        $this->selected_id = $id; 
		$this->cedula = $record-> cedula;
		$this->nombre = $record-> nombre;
		$this->direccion = $record-> direccion;
		$this->telefono = $record-> telefono;
		$this->email = $record-> email;
		$this->foto = $record-> foto;
    }

    public function update()
    {
        $this->validate([
            'cedula' => 'nullable|min:10|max:13|unique:proveedores',
			'telefono' => 'nullable|max:10',
			'email' => 'nullable|email',
			'direccion' => 'nullable|max:50',
			'nombre' => 'required|max:50',
			'foto' => 'nullable|max:200'
        ]);

        if ($this->selected_id) {
			$record = Proveedore::find($this->selected_id);
            $record->update([ 
			'cedula' => $this-> cedula,
			'nombre' => $this-> nombre,
			'direccion' => $this-> direccion,
			'telefono' => $this-> telefono,
			'email' => $this-> email
            ]);

            if(isset($this->foto) && is_file($this->foto) && $record->foto != $this->foto){
				$record->update([ 
					'foto'=>$this->foto->store('imgproveedores','public')
				]);
            }

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Proveedore Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Proveedore::where('id', $id)->delete();
        }
    }
}