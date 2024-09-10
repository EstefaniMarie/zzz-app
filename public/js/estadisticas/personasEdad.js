$(document).ready(() => {

    bgColor = [
        'rgba(255, 99, 132, 0.2)', // 0 - 10
        'rgba(54, 162, 235, 0.2)', // 11 - 20
        'rgba(255, 206, 86, 0.2)', // 21 - 30
        'rgba(75, 192, 192, 0.2)', // 31 - 40
        'rgba(153, 102, 255, 0.2)', // 41 - 50
        'rgba(255, 159, 64, 0.2)', // 51 - 60
        'rgba(0, 0, 0, 0.2)', // 61 - 70
        'rgba(128, 0, 0, 0.2)', // 71 - 80
        'rgba(128, 128, 128, 0.2)' // 80+
    ]
    
    borderColor = [
        'rgba(255, 99, 132, 1)', // 0 - 10
        'rgba(54, 162, 235, 1)', // 11 - 20
        'rgba(255, 206, 86, 1)', // 21 - 30
        'rgba(75, 192, 192, 1)', // 31 - 40
        'rgba(153, 102, 255, 1)', // 41 - 50
        'rgba(255, 159, 64, 1)', // 51 - 60
        'rgba(0, 0, 0, 1)', // 61 - 70
        'rgba(128, 0, 0, 1)', // 71 - 80
        'rgba(128, 128, 128, 1)' // 80+
    ]
    
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
                data: '{{$pacientesEdad}}',
                backgroundColor: bgColor,
                borderColor: borderColor,
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