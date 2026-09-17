import Services from '../services';

export default class Inicio {

    cargarMetodos() {

        this.inicializarInicio();

    }

    inicializarInicio() {

        this.estadoMiembros();
        this.miembrosMinisterio();
        this.crecimientoMiembros();
        this.cumplimientoProgramacion();
        this.distribucionActividades();
        this.distribucionActividades();
        this.crecimientoMiembroArea();

    }

    // this.crearSparkline()
    // this.crearMiniBar()
    // this.crearMiniLinea()
    // this.crearMiniRadial()
   
    // crearSparkline() {
    //     Services.chart.crearSparkline(
    //         'grafica-total',
    //         [20, 25, 22, 30, 28, 35, 40],
    //         '#16a34a',
    //         40
    //     );
    // }

    // crearMiniBar() {
    //     Services.chart.crearMiniBar(
    //         'grafica-activos',
    //         [5, 8, 6, 10, 9, 12, 11, 14],
    //         '#22c55e',
    //         40
    //     );
    // }

    // crearMiniLinea() {
    //     Services.chart.crearMiniLinea(
    //         'grafica-inactivos',
    //         [8, 7, 7, 6, 5, 5, 4, 3],
    //         '#ef4444',
    //         40
    //     );
    // }

    // crearMiniRadial() {
    //     Services.chart.crearMiniRadial(
    //         'grafica-radial',
    //         88,
    //         '#16a34a',
    //         40
    //     );
    // }







    estadoMiembros() {

        Services.chart.crearDonut(
            'grafica-miembros-inicio',
            [
                120,
                35,
                18
            ],
            [
                'Activos',
                'Inactivos',
                'Suspendidos'
            ]
        );

    }

    miembrosMinisterio() {

        Services.chart.crearBarra(
            'grafica-ministerios',

            [
                'Alabanza',
                'Sonido',
                'Video',
                'Ujieres',
                'Infantil'
            ],

            [
                {
                    name: 'Miembros',
                    data: [25, 18, 12, 15, 20]
                }
            ]
        );

    }

    crecimientoMiembros() {

        Services.chart.crearLinea(

            'grafica-crecimiento',

            [
                'Ene',
                'Feb',
                'Mar',
                'Abr',
                'May',
                'Jun'
            ],

            [
                {
                    name: 'Miembros',
                    data: [25, 35, 45, 52, 70, 90]
                }
            ]

        );

    }

    cumplimientoProgramacion() {

        Services.chart.crearRadial(

            'grafica-cumplimiento',

            [
                82
            ],

            [
                'Cumplimiento'
            ]

        );

    }

    participacionMinisterios() {

        Services.chart.crearPie(

            'grafica-pie-ministerios-inicio',

            [
                35,
                25,
                15,
                12,
                13
            ],

            [
                'Alabanza',
                'Sonido',
                'Multimedia',
                'Ujieres',
                'Infantil'
            ],
            300

        );

    }

    distribucionActividades() {

        Services.chart.crearPolar(

            'grafica-polar-actividades',

            [
                18,
                10,
                8,
                5,
                3
            ],

            [
                'Cultos',
                'Ensayos',
                'Reuniones',
                'Eventos',
                'Vigilias'
            ],
            300

        );

    }

    crecimientoMiembroArea() {

        Services.chart.crearArea(

            'grafica-area-miembros',

            [
                'Ene',
                'Feb',
                'Mar',
                'Abr',
                'May',
                'Jun',
                'Jul'
            ],

            [
                {
                    name: 'Miembros',
                    data: [80, 95, 110, 125, 140, 155, 180]
                }
            ],
            300

        );

    }
}

new Inicio().cargarMetodos();
