let isRequestPending = false

function downloadBackup(ruta) {
    if (isRequestPending) return

    isRequestPending = true

    $(this).text('Exportando...');
    $(this).removeClass('btn-success')
    $(this).addClass('btn-info')

    $.ajax({
        type: 'GET',
        url: '/respaldo/exportar',
        data: {
            ruta
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: function(data, status, xhr) {
            const filename = xhr.getResponseHeader('Content-Disposition').split('filename=')[1].trim();
            const blob = new Blob([data], { type: 'application/zip' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            a.click();
            URL.revokeObjectURL(url);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText)
            alert(`Error exportando backup: `, xhr.responseText)
        }
    }).always(() => {
        isRequestPending = false
        $(this).text('Exportar')

        $(this).removeClass('btn-info')
        $(this).addClass('btn-success')
    })
}