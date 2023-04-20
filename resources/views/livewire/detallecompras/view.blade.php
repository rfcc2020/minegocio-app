@section('title', __('Detallecompras'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Detallecompra Listing </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<p>Desde: </p>
							<input wire:model='keyWord' type="date" class="form-control" name="search" id="search" placeholder="Search Detallecompras">
						</div>
						<div>
							<p>Hasta: </p>
							<input wire:model='keyWord2' type="date" class="form-control" name="search" id="search" placeholder="Search Detallecompras">
						</div>
					</div>
				</div>
				
				<div class="card-body">
				@include('livewire.detallecompras.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Id</th>
								<th>Fecha</th>
								<th>Proveedor</th>
								<th>Subtotal</th>
								<th>Descuento</th>
								<th>Iva</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							@forelse($detallecompras as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->id }}</td>
								<td>{{ $row->fecha }}</td>
								<td>{{ $row->proveedor }}</td>
								<td>{{ $row->subtotal }}</td>
								<td>{{ $row->descuento }}</td>
								<td>{{ $row->iva }}</td>
								<td>{{ $row->total }}</td>
								<td>
								<a data-bs-toggle="modal" data-bs-target="#createDataModal" class="dropdown-item" wire:click="consultarDetalle({{$row->id}})"><i class="fa fa-edit"></i> Ver Detalle </a>
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>						
					<div class="float-end">{{ $detallecompras->links() }}</div>
					<div>
						<h2>Total: {{$detallecompras->sum('total')}}</h2>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>