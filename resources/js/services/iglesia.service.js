import Services from "./index";

export default class IglesiaService {

    inicializar() {

        $("#selectIglesia").off("change").on("change", (e) => {

            const iglesia = $(e.currentTarget).val();

            this.seleccionar(iglesia);

        });

    }

    async seleccionar(id) {

        if (!id) {
            Services.alerta.advertencia('Debe seleccionar una iglesia para visualizar y administrar la información.');
            $("#botones,#panel-body").hide();
            return;
        }
        await Services.peticion.request('/iglesia/seleccionar', {
            data: {
                iglesia_id: id
            },
            loader: 'progress'
        });

        location.reload();
        $("#botones,#panel-body").show();

    }

}