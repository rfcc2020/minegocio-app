<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Detallecompra</h5>
                <button wire:click.prevent="cancelProducto()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="compra_id"></label>
                        <input wire:model="compra_id" type="hidden" class="form-control" id="compra_id" placeholder="Compra Id">@error('compra_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                    <select name="producto_id" id="producto_id" class="form-control" wire:model="producto_id">
						<option value="0">Seleccione</option>
                                @foreach($productos as $p)
                                    <option value="{{$p->id}}">{{$p->nombre}}</option>
                                @endforeach
					</select>
                    <span>stock: {{$stockProducto}} Costo: {{$precioProducto}} Precio Sugerido: {{$precioSugeridoProducto}}</span>
                    @error('producto_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="cantidadProducto"></label>
                        <input wire:model="cantidadProducto" type="text" class="form-control" id="cantidadProducto" placeholder="Cantidad">@error('cantidadProducto') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="valorProducto"></label>
                        <input wire:model="valorProducto" type="text" class="form-control" id="valorProducto" placeholder="Valor">@error('valorProducto') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="addProducto()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Add service Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateDataModalLabel">Create New Detallecompra</h5>
                <button wire:click.prevent="cancelServicio()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="compra_id"></label>
                        <input wire:model="compra_id" type="hidden" class="form-control" id="compra_id" placeholder="Compra Id">@error('compra_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                    <select name="servicio_id" id="servicio_id" class="form-control" wire:model="servicio_id">
						<option value="0">Seleccione</option>
                                @foreach($servicios as $s)
                                    <option value="{{$s->id}}">{{$s->nombre}}</option>
                                @endforeach
					</select>
                    @error('servicio_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="cantidadServicio"></label>
                        <input wire:model="cantidadServicio" type="text" class="form-control" id="cantidadServicio" placeholder="Cantidad">@error('cantidadServicio') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="valorServicio"></label>
                        <input wire:model="valorServicio" type="text" class="form-control" id="valorServicio" placeholder="Valor">@error('valorServicio') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="addServicio()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>