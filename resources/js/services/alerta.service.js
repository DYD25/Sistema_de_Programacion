export default class AlertaService {

    mostrar({ icon = "info", title = "", text = "", confirmButtonText = "Aceptar", cancelButtonText = null }) {

        Swal.fire({
            icon,
            title,
            html: text,
            confirmButtonText,
            cancelButtonText
        });

    }

    error(texto, titulo = "Error") {

        this.mostrar({
            icon: "error",
            title: titulo,
            text: texto
        });
    }

    exito(texto, titulo = "Correcto") {

        this.mostrar({
            icon: "success",
            title: titulo,
            text: texto
        });
    }

    info(texto, titulo = "Información") {

        this.mostrar({
            icon: "info",
            title: titulo,
            text: texto
        });
    }

    advertencia(texto, titulo = "Atención", confirmButtonText = "Entendido") {

        this.mostrar({
            icon: "warning",
            title: titulo,
            text: texto,
            confirmButtonText
        });
    }

  
}