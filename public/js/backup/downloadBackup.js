let isRequestPending = false

$(document).ready(function() {
    $('#exportarBackup').on('click', function() {
        if (isRequestPending) return

        isRequestPending = true

        $(this).text('Exportando...');
        $(this).removeClass('btn-success')
        $(this).addClass('btn-info')

        $.ajax({
            type: 'GET',
            url: '/respaldo/exportar',
            // data: {_token: '{{ csrf_token() }}'},
            success: function(response) {
                // Handle the response, e.g. download the backup file
                window.location.href = response
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText)
                alert(`Error generando backup: ${xhr.responseText}`)
            }
        }).always(() => {
            isRequestPending = false
            $(this).text('Exportar')

            $(this).removeClass('btn-info')
            $(this).addClass('btn-success')
        })
       
    })

})