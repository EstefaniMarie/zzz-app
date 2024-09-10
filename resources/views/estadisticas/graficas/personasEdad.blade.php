<div id="PersonasEdad">
    <canvas id="personasEdad" width="400" height="200"></canvas>
    {{-- <p>{{$pacientesEdad}}</p> --}}
</div>

<script>
    $(document).ready(() => {
        let pacientesEdad = <?php echo $pacientesEdad; ?>

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
                labels: Object.keys(pacientesEdad),
                datasets: [{
                    label:  'Cantidad de pacientes',
                    data: Object.values(pacientesEdad),
                    backgroundColor: bgColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }]
            },
        
        });
    })
</script>