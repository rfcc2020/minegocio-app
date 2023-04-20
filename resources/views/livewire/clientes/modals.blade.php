<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">{{ __('Create') }} {{ __('New') }} Cliente</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="cedula"></label>
                        <input wire:model="cedula" type="text" class="form-control" id="cedula" placeholder="Cedula">@error('cedula') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nombre"></label>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="apellido"></label>
                        <input wire:model="apellido" type="text" class="form-control" id="apellido" placeholder="Apellido">@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="direccion"></label>
                        <input wire:model="direccion" type="text" class="form-control" id="direccion" placeholder="Direccion">@error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefono"></label>
                        <input wire:model="telefono" type="text" class="form-control" id="telefono" placeholder="Telefono">@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email"></label>
                        <input wire:model="email" type="email" class="form-control" id="email" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto"></label>
                        <input wire:model="foto" type="text" class="form-control" id="foto" placeholder="Foto">@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">{{ __('Close') }} </button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">{{ __('Save') }} </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Cliente</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="cedula"></label>
                        <input wire:model="cedula" type="text" class="form-control" id="cedula" placeholder="Cedula">@error('cedula') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nombre"></label>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="apellido"></label>
                        <input wire:model="apellido" type="text" class="form-control" id="apellido" placeholder="Apellido">@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="direccion"></label>
                        <input wire:model="direccion" type="text" class="form-control" id="direccion" placeholder="Direccion">@error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefono"></label>
                        <input wire:model="telefono" type="text" class="form-control" id="telefono" placeholder="Telefono">@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email"></label>
                        <input wire:model="email" type="email" class="form-control" id="email" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input wire:model="foto" type="file" class="form-control" id="foto" placeholder="foto">@error('imagen') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <img src="{{ asset('storage/'. $foto) }}" alt="" width="50%">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
       </div>
    </div>
</div>
