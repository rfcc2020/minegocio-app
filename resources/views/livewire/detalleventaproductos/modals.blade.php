<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Detalle de venta</h5>
                <button wire:click.prevent="cerrarDetalle()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
           <div class="table-responsive">
				<table class="table table-bordered table-sm">
                <thead class="thead">
							<tr> 
								<th>Producto</th>
								<th>Cantidad</th>
                                <th>Precio Unitario</th>
								<th>Total</th>
							</tr>
						</thead>
                        <tbody>
                            @if($detalleProducto != null)
							@forelse($detalleProducto as $p)
							<tr>
								<td>{{ $p->nombre }}</td>
								<td>{{ $p->cantidad }}</td>
								<td>{{ $p->valor }}</td>
								<td>{{ $p->total }}</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
                            @endif
						</tbody>
                </table>
            </div>
            <div class="table-responsive">
				<table class="table table-bordered table-sm">
                <thead class="thead">
							<tr> 
								<th>Servicio</th>
								<th>Cantidad</th>
                                <th>Precio Unitario</th>
								<th>Total</th>
							</tr>
						</thead>
                        <tbody>
                            @if($detalleServicio!=null)
							@forelse($detalleServicio as $s)
							<tr>
								<td>{{ $s->nombre }}</td>
								<td>{{ $s->cantidad }}</td>
								<td>{{ $s->valor }}</td>
								<td>{{ $s->total }}</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
                            @endif
						</tbody>
                </table>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cerrarDetalle()" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>