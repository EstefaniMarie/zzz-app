$(document).ready(() => {


    const chart = new Chart($('#personasEdad'), {
        type: 'polarArea',
        data: {
            labels: [
                '0 - 10',
                '11 - 20',
                '21 - 30',
                '31 - 40',
                '41 - 50',
                '51 - 60',
                '61 - 70',
                '71 - 80',
                '80+'
            ],
            datasets: [{
                label:  [
                    '0 - 10',
                    '11 - 20',
                    '21 - 30',
                    '31 - 40',
                    '41 - 50',
                    '51 - 60',
                    '61 - 70',
                    '71 - 80',
                    '80+'
                ],
                data: [],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        // options: {
        //     scales: {
        //         x: {
        //             title: {
        //                 display: true,
        //                 text: 'Días del mes'
        //             },
        //             min: 1, // mínimo valor del eje x (día 1 del mes)
        //             max: 30, // máximo valor del eje x (día 30 del mes)
        //             stepSize: 1, // paso del eje x (1 día)
        //             ticks: {
        //                 stepSize: 1 // mostrar todos los días del mes
        //             }
        //         },
        //         y: {
        //             title: {
        //                 display: true,
        //                 text: 'Número de consultas'
        //             },
        //             min: 0, // mínimo valor del eje y (0 consultas)
        //             max: 50, // máximo valor del eje y (100 consultas)
        //             stepSize: 5, // paso del eje y (5 consultas)
        //             ticks: {
        //                 stepSize: 5 // mostrar números con una diferencia de 5
        //             }
        //         }
        //     }
        // }
    });
})