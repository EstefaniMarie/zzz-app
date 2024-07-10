let table = new DataTable('#UsuariosTable',{
    paging: false ,
    scrollCollapse: true,
    scrollY: '50vh',
    scrollX: true,
    fixedHeader: true,
    layout: {
        topStart: {
            search: {
                placeholder: 'Inserte por nombre, cedula o edad'
            },
        },
        topEnd: null
    },
    columns: [
        { "width": "20%" },
        { "width": "30%" },
        { "width": "50%" }
    ],
    language: {
        "decimal": "",
        "emptyTable": "Usuario(s) no existente(s)",
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

table.on('click', 'tbody tr', (e) => {
    let classList = e.currentTarget.classList;

    if (classList.contains('selected')) {
        classList.remove('selected');
    } else {
        table.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
        classList.add('selected');
    }
    
    let selectedRows = table.rows('.selected').data().toArray();
    console.log(selectedRows);
});