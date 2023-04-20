@section('title', __('Compras'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Datos del proveedor</h4>
				</div>
				<div class="card-body">
					<select name="proveedor_id" id="proveedor_id" wire:model="proveedor_id" >
						<option value="0">Seleccione</option>
                                @foreach($proveedores as $p)
                                    <option value="{{$p->id}}">{{$p->nombre}}</option>
                                @endforeach
					</select>
					<label for="proveedor_id">@error('proveedor_id') <span class="error text-danger">{{ $message }}</span> @enderror</label>
					<div class="btn btn-sm btn-info">
						<a href="{{ url('/proveedores') }}">
						<i class="fa"></i>  Agregar proveedor
						</a>
					</div>
					
                        <label for="fecha">Fecha: </label>
                        <input wire:model="fecha" type="date" id="fecha" value="{{$fecha}}">@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
                   
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Compra Listing </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Compras">
						</div>
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Productos
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.compras.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Total</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@if($detalleCompra!=null)
							@forelse($detalleCompra as $d)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{$d['nombre']}}</td>
								<td>{{$d['cantidad']}}</td>
								<td>{{$d['valor']}}</td>
								<td>{{$d['total']}}</td>
								<td width="90">
									<a class="dropdown-item" onclick="confirm('Confirm Delete Compra id {{$d['producto_id']}}? \nDeleted Compras cannot be recovered!')||event.stopImmediatePropagation()" wire:click="quitarProductoDetalle({{$d['producto_id']}})"><i class="fa fa-trash"></i> Delete </a>
									</div>								
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
							@endif
						</tbody>
					</table>						
					<div class="float-end">{{ $compras->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Totales</h4>
				</div>
				<div class="card-body">	
					<div>
					<label for="subtotal">Subtotal: </label>
                        <input wire:model="subtotal" type="text" readonly id="fecha">@error('subtotal') <span class="error text-danger">{{ $message }}</span> @enderror
					</div>			
                        <div>
						<label for="descuento">Descuento: </label>
                        <input wire:model="descuento" type="text" readonly id="descuento">@error('subtotal') <span class="error text-danger">{{ $message }}</span> @enderror
						</div>
						<div>
						<label for="iva">Iva: </label>
                        <input wire:model="iva" type="text" readonly id="iva">@error('iva') <span class="error text-danger">{{ $message }}</span> @enderror
						</div>
						<div>
						<label for="total">Total: </label>
                        <input wire:model="total" type="text" readonly id="total">@error('total') <span class="error text-danger">{{ $message }}</span> @enderror

						</div>
						<div>
						<label for="observacion">Observacion: </label>
                        <input wire:model="observacion" type="text" id="observacion">@error('total') <span class="error text-danger">{{ $message }}</span> @enderror
						
						</div>

						<div>
							<button type="button" wire:click.prevent="guardarCompra()" class="btn btn-primary">Guardar</button>
						</div>

						
				</div>
			</div>
		</div>
	</div>
</div>