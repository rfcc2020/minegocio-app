@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div>
        <form method="POST" action="">
            @csrf
            <h5>Desde:<input type="date" id='f1' name='f1' value="{{ $f1 }}"></h5>
            <h5>Hasta: <input type="date" id='f2' name='f2' value="{{ $f2 }}"></h5>
            <button class="btn btn-sm btn-info" type="submit"> Consultar </button>
        </form>
        </div>
        <div class="col-md-4">
            <h1>Reporte </h1>
            <h2>Ingresos: {{ $detalleventas->sum('pagado') }}</h2>
            <h2>Egresos: {{ $detallecompras->sum('total') }}</h2>
            @if($detalleventas->sum('pagado') > $detallecompras->sum('total'))
            <h2>
                Utilidad: {{ $detalleventas->sum('pagado') - $detallecompras->sum('total') }}
            </h2>
            @else
            <h2>
                Pérdida: {{ $detallecompras->sum('total') - $detalleventas->sum('pagado') }}
            </h2>
            @endif
        </div>  
        <div class="col-md-8">
            <canvas id="myChart"></canvas>
        </div> 
    </div>   
</div> 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  let ventas = ({{ $detalleventas->sum('pagado') }});
  let compras = ({{ $detallecompras->sum('total') }});

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Ingresos', 'Egresos'],
      datasets: [{
        label: '$',
        data: [ventas, compras],
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script> 
@endsection

