import DataTable from "datatables.net-bs5";

const table = document.getElementById('qr-codes-table');

let dataTable;
document.addEventListener('DOMContentLoaded', function() {
    dataTable = new DataTable(table, {
        retrieve: true,
        processing: true,
        bAutoWidth: true,
        pageLength: 10,
        aaSorting: [[0, "desc"]],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.3.5/i18n/es-ES.json',
            emptyTable: 'No posee códigos QR',
            zeroRecords: 'No se han encontrado códigos QR',
            infoEmpty: 'Mostrando 0 de 0 códigos QR',
            infoFiltered: '(filtrados de un total de _MAX_ códigos QR)',
            search: 'Buscar:',
            searchPlaceholder: 'Buscar...',
            lengthMenu: 'Mostrar _MENU_ códigos QR',
            paginate: {
                first: 'Primero',
                last: 'Último',
                next: 'Siguiente',
                previous: 'Anterior'
            },
            aria: {
                sortAscending: ': Activar para ordenar la columna de manera ascendente',
                sortDescending: ': Activar para ordenar la columna de manera descendente'
            }
        },
        ajax: {
            url: '/qr-codes/all',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'content' },
            { 
                data: 'active',
                render: function(data, type, row) {
                    if (data) {
                        return '<span class="badge bg-success">Activo</span>';
                    } else {
                        return '<span class="badge bg-danger">Inactivo</span>';
                    }
                }
            },
            { 
                render: function(data, type, row) {
                    return `
                        <div class="btn-group">
                            <a 
                                href="/qr-codes/${row.id}" 
                                class="btn btn-primary btn-sm"
                            >
                                Ver
                            </a>
                            <a 
                                href="/qr-codes/${row.id}/edit" 
                                class="btn btn-warning btn-sm"
                            >
                                Editar
                            </a>
                            <button 
                                type="button" 
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="${row.id}"
                            >
                                Eliminar
                            </button>
                        </div>
                    `;
                }
            }
        ],
        initComplete: function () {
            table.classList.remove('table-bordered');
        },
    });
});