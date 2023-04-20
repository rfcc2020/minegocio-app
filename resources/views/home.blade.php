@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><h5><span class="text-center fa fa-home"></span> @yield('title')</h5></div>
			<div class="card-body">
				<h5>Hi <strong>{{ Auth::user()->name }},</strong> {{ __('You are logged in to ') }}{{ config('app.name', 'Laravel') }}</h5>
				</br> 
				<hr>
								
			<div class="row w-100">
					<div class="col-md-12">
						<div class="card border-warning mx-sm-1 p-3">
							<div class="card border-success text-sucess p-3" ><span class="text-center fa fa-plane-departure" aria-hidden="true"></span></div>
							<div class="text-success text-center mt-3"><h4>MULTISERVICIOS</h4></div>
							<div class="text-info text-center mt-2"><h1>RFCC-2023</h1></div>
						</div>
					</div>
				 </div>				
			</div>
		</div>
	</div>
</div>
</div>
@endsection