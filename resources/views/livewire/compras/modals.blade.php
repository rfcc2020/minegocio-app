<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Detallecompra</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    @error('producto_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="cantidad"></label>
                        <input wire:model="cantidad" type="text" class="form-control" id="cantidad" placeholder="Cantidad">@error('cantidad') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="valor"></label>
                        <input wire:model="valor" type="text" class="form-control" id="valor" placeholder="Valor">@error('valor') <span class="error text-danger">{{ $message }}</span> @enderror
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

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Detallecompra</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="compra_id"></label>
                        <input wire:model="compra_id" type="hidden" class="form-control" id="compra_id" placeholder="Compra Id">@error('compra_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="producto_id"></label>
                        <input wire:model="producto_id" type="text" class="form-control" id="producto_id" placeholder="Producto Id">@error('producto_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="cantidad"></label>
                        <input wire:model="cantidad" type="text" class="form-control" id="cantidad" placeholder="Cantidad">@error('cantidad') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="valor"></label>
                        <input wire:model="valor" type="text" class="form-control" id="valor" placeholder="Valor">@error('valor') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="total"></label>
                        <input wire:model="total" type="text" class="form-control" id="total" placeholder="Total">@error('total') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
            </div>
       </div>
    </div>
</div>
