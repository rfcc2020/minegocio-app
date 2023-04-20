@section('title', __('Saldos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Saldo Listing </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Saldos">
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.saldos.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Venta Id</th>
								<th>Cliente</th>
								<th>Valor</th>
								<th>Estado</th>	
							</tr>
						</thead>
						<tbody>
							@forelse($saldos as $row)
							@if($row->estado == 'pendiente')
								<tr class="table-danger">
							@else
							<tr class="table-success">
							@endif
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->venta_id }}</td>
								<td>{{$row->nombre}} {{$row->apellido}}</td>
								<td>{{ $row->valor }}</td>
								<td>{{ $row->estado }}</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>					
					<div class="float-end">{{ $saldos->links() }}</div>
					<div>
						<h2>Total Pendiente: {{$saldos->sum('valor','estado','pendiente')}}</h2>
					</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>