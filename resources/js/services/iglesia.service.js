import Services from "./index";

export default class IglesiaService {

    inicializar() {
        // Validar al cargar la página
        this.validarContexto();

        $("#selectIglesia").off("change").on("change", (e) => {
            let iglesia = $(e.currentTarget).val();
            this.seleccionar(iglesia);
        });

    }

    validarContexto() {
        let iglesia = $("#selectIglesia").val();

        if (!iglesia) {
            this.mostrarContenido(false);
            Services.alerta.advertencia('Debe seleccionar una iglesia para visualizar y administrar la información.');
            return false;
        }

        this.mostrarContenido(true);
        return true;
    }

    async seleccionar(id) {

        if (!id) {
            this.mostrarContenido(false);
            Services.alerta.advertencia('Debe seleccionar una iglesia para visualizar y administrar la información.');
            return;
        }

        await Services.peticion.request('/iglesia/seleccionar', {
            data: {
                iglesia_id: id
            },
            loader: 'progress'
        });

        location.reload();
    }

    mostrarContenido(mostrar = true) {
        $("#botones,#panel-body").toggle(mostrar);
    }


}