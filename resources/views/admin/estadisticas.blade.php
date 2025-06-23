@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Estadísticas Mensuales</h2>

    <div class="card">
        <div class="card-header">Artistas Individuales por Departamento (Mes Actual)</div>
        <div class="card-bodgy">
            <canvas id="graficoDepartamentos"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
   document.addEventListener("DOMContentLoaded", () => {
    fetch("{{ route('admin.estadisticas.datos') }}")
        .then(response => response.json())
        .then(data => {
            console.log('Datos recibidos:', data); // 👈 Añade esto

            const labels = data.map(item => item.departamento);
            const values = data.map(item => item.total);

            const ctx = document.getElementById('graficoDepartamentos').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total registrados',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error al cargar los datos:', error);
        });
});

</script>
@endsection
