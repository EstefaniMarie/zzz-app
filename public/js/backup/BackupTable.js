new DataTable('#BackupTable',{
    paging: false ,
    scrollCollapse: true,
    scrollY: '50vh',
    scrollX: true,
    fixedHeader: true,
    layout: {
        topStart: {
            search: {
                placeholder: 'Busqueda'
            },
            
        },
        topEnd: 'buttons'
    },
    buttons: [
        {
            text: 'Exportar ',
            className: 'btn btn-success text-white my-2',
            attr: {
                id: 'exportarBackup'
            }
        }
    ],
    language: {
        "decimal": "",
        "emptyTable": "No se ha hecho ningún respaldo",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }
})