$(document).ready(function () {
    const consultasSelect = $('#graficaConsultas')

    $('#graficaConsultas select').select2({
        placeholder: 'Seleccionar médico',
        language: {'noResults': () => { return 'No hay médicos'; }},
    })

    const graficaCanvas = document.getElementById('grafica-consultas');

    // Crear un objeto Chart.js
    const chart = new Chart(graficaCanvas, {
        type: 'line',
        data: {
            labels: [
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre',
            ],
            datasets: [{
                label: 'Consultas por mes',
                data: [],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Días del mes'
                    },
                    min: 1, // mínimo valor del eje x (día 1 del mes)
                    max: 30, // máximo valor del eje x (día 30 del mes)
                    stepSize: 1, // paso del eje x (1 día)
                    ticks: {
                        stepSize: 1 // mostrar todos los días del mes
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Número de consultas'
                    },
                    min: 0, // mínimo valor del eje y (0 consultas)
                    max: 50, // máximo valor del eje y (100 consultas)
                    stepSize: 5, // paso del eje y (5 consultas)
                    ticks: {
                        stepSize: 5 // mostrar números con una diferencia de 5
                    }
                }
            }
        }
    });

    $('#graficaConsultas').on('change', async () => {
        // Obtener la cédula del médico seleccionado
        const cedulaMedico = consultasSelect.value;

        // Realizar la consulta al backend para obtener los datos
        const response = await fetch('/estadisticas/consultasMedico', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cedulaMedico })
        });

        // Procesar la respuesta del backend
        const datos = await response.json();

        // Actualizar la gráfica con los nuevos datos
        chart.data.labels = Object.keys(datos);
        chart.data.datasets[0].data = Object.values(datos);
        chart.update();
    });
})
