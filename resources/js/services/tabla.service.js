import { createIcons, icons } from 'lucide';
export default class TablaService {

    constructor() {
        this.tablas = {};

        this.language = {
            emptyTable: "Sin datos...",
            search: "",
            info: "Mostrando _START_ a _END_ de _TOTAL_",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            }
        };
    }

    crear({ id, data = [], columns = [], exportar = [],options = {} }) {

        if (this.tablas[id]) {
            this.actualizar(id, data);
            return this.tablas[id];
        }

        // const botones = this.obtenerBotones(exportar);
        
        this.tablas[id] = $(id).DataTable({
            processing: true,
            serverSide: false,
            searching: true,
            paging: true,
            ordering: true,
            lengthChange: false,
            responsive: true,
            autoWidth: false,
            language: this.language,
            data,
            columns,
            // dom: botones.length ? 'Bfrtip' : 'frtip',
            // buttons:  this.obtenerBotones(exportar),
    
            initComplete: function () {
                $('.dataTables_filter input').attr('placeholder', 'Buscar...');
            },
            drawCallback: function () {
                createIcons({ icons });
                 Services.tooltip.recargar();
            },
            ...options
             
        });
        // createIcons({ icons });

        return this.tablas[id];

    }

    actualizar(id, data = []) {

        const tabla = this.tablas[id];

        if (!tabla) return;

        tabla.clear();
        tabla.rows.add(data);
        tabla.draw(false);
    }

    // obtener(id) {
    //     return this.tablas[id] ?? null;
    // }

    evento(id, selector, callback) {

        const tabla = this.tablas[id];
        
        if (!tabla) return;
        $(tabla.table().body()).off('click', selector);
        $(tabla.table().body()).on('click', selector, (e) => {
            e.preventDefault();
            callback(
                tabla.row($(e.currentTarget).closest('tr')).data()
            );
        });
    }

    // obtenerBotones(exportar = []) {

    //     const disponibles = {
    
    //         excel: {
    //             extend: 'excelHtml5',
    //             text: 'Excel'
    //         },
    
    //         pdf: {
    //             extend: 'pdfHtml5',
    //             text: 'PDF'
    //         },
    
    //         csv: {
    //             extend: 'csvHtml5',
    //             text: 'CSV'
    //         },
    
    //         print: {
    //             extend: 'print',
    //             text: 'Imprimir'
    //         }
    
    //     };
    
    //     return exportar
    //         .filter(tipo => disponibles[tipo])
    //         .map(tipo => disponibles[tipo]);
    
    // }
}