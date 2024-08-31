<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-profile.css">

    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('theme/CryptoDash/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"
            type="text/javascript"></script>
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/account-profile.js"
            type="text/javascript">
            </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </x-slot>
    <x-slot name='header'>
        <div class="content-header-left col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Estadísticas</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Estadísticas</li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6 text-center">
                <h5>Pacientes por género</h5>
                <div class="chart-container">
                    <canvas class="genero" id="generoChart"></canvas>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <h5>Médicos por especialidades</h5>
                <div class="chart-container">
                    <canvas class="especialidades" id="especialidadesChart"></canvas>
                </div>
            </div>
            <div class="mt-5 col-md-6 text-center">
                <h5>Consultas por mes del año actual</h5>
                <div class="chart-container">
                    <canvas class="consultas" id="citasChart"></canvas>
                </div>
            </div>
            <div class="mt-5 col-md-6 text-center">
                <h5>Estatus de los usuarios</h5>
                <div class="chart-container">
                    <canvas class="usuarios" id="usuariosChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .genero {
        width: 200px !important;
        height: 200px !important;
    }

    .especialidades {
        width: 400px !important;
        height: 200px !important;
    }

    .consultas {
        width: 400px !important;
        height: 200px !important;
    }

    .usuarios {
        width: 200px !important;
        height: 200px !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var data = @json($data);

        var labels = data.map(function (item) { return item.genero; });
        var values = data.map(function (item) { return item.cantidad; });

        var ctx = document.getElementById('generoChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var especialidades = @json($especialidades);

        var labels = especialidades.map(function (item) { return item.especialidad; });
        var values = especialidades.map(function (item) { return item.cantidad_medicos; });

        var ctx = document.getElementById('especialidadesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Médicos',
                    data: values,
                    backgroundColor: [
                        '#1427ce', '#71ed1e', '#1eedcf', '#edec1e', '#ed1ee5',
                        '#861eed', '#ed1e43', '#ed871e', '#9b81ba', '#778731',
                        '#317287', '#93b391', '#280a3c', '#e54fee'
                    ],
                    borderColor: '#d3d5e7',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Especialidades'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Médicos'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var citasData = @json($citas);

        var labels = citasData.map(function (item) { return item.Mes; });
        var values = citasData.map(function (item) { return item.Cantidad_Citas; });

        var ctx = document.getElementById('citasChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Citas',
                    data: values,
                    backgroundColor: [
                        '#89cb4f', '#4f8ccb', '#182e70', '#517018', '#e5c123',
                        '#23dfe5', '#8854a4', '#f50d0d', '#803c3c', '#e016a0',
                        '#68dd5a', '#ed871e'
                    ],
                    borderColor: '#d3d5e7',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Mes'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Citas'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            var usuariosData = @json($usuarios);

            var ctx = document.getElementById('usuariosChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Activos', 'Bloqueados'],
                    datasets: [{
                        label: 'Número de Usuarios',
                        data: [usuariosData.usuarios_activos, usuariosData.usuarios_bloqueados],
                        backgroundColor: [
                            '#27ea10',
                            '#fc0505' 
                        ],
                        borderColor: [
                            '#27ea10', 
                            '#fc0505' 
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>