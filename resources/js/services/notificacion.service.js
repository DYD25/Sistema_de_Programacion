export default class NotificacionService {

    constructor() {
        this.alerta = document.getElementById('alerta');
        this.titulo = document.getElementById('alerta-titulo');
        this.mensaje = document.getElementById('alerta-mensaje');
        this.icono = document.getElementById('alerta-icono');
        this.botonCerrar = document.getElementById('cerrar-alerta');

        this.timeout = null;
    }

    inicializar() {

        this.botonCerrar?.addEventListener('click', () => {
            this.ocultar();
        });

    }

    success(mensaje, titulo = 'Éxito') {
        this.mostrar(titulo, mensaje, 'success');
    }

    warning(mensaje, titulo = 'Advertencia') {
        this.mostrar(titulo, mensaje, 'warning');
    }

    error(mensaje, titulo = 'Error') {
        this.mostrar(titulo, mensaje, 'error');
    }

    info(mensaje, titulo = 'Información') {
        this.mostrar(titulo, mensaje, 'info');
    }

    mostrar(titulo, mensaje, tipo) {

        if (!this.alerta) return;

        clearTimeout(this.timeout);

        const estilos = this.obtenerEstilos(tipo);

        this.alerta.className = `
        fixed top-5 right-5 z-[9999]
        min-w-[350px] max-w-md
        rounded-lg shadow-lg p-4
        border-l-4
        transition-all duration-300
        translate-x-full opacity-0
        ${estilos.fondo}
        ${estilos.borde}
    `;
    
        // Título
        this.titulo.textContent = titulo;
        this.titulo.className = `text-2xl font-semibold ${estilos.titulo}`;

        // Mensaje
        this.mensaje.textContent = mensaje;
        this.mensaje.className = `text-sm mt- ${estilos.mensaje}`;

        this.alerta.classList.remove('hidden');

        requestAnimationFrame(() => {

            this.alerta.classList.remove('translate-x-full');
            this.alerta.classList.remove('opacity-0');

        });

        this.timeout = setTimeout(() => {

            this.ocultar();

        }, 5000)

    }

    ocultar() {
        if (!this.alerta) return;

        this.alerta.classList.add('translate-x-full');
        this.alerta.classList.add('opacity-0');

        setTimeout(() => {

            this.alerta.classList.add('hidden');

        }, 500);
    }

    obtenerEstilos(tipo) {

        switch (tipo) {

            case 'success':
                return {
                    fondo: 'bg-green-50',
                    borde: 'border-green-500',
                    titulo: 'text-green-800',
                    mensaje: 'text-green-700',
                    icono: 'text-green-600',
                };

            case 'warning':
                return {
                    fondo: 'bg-yellow-50',
                    borde: 'border-yellow-500',
                    titulo: 'text-yellow-800',
                    mensaje: 'text-yellow-700',
                    icono: 'text-yellow-600',
                };

            case 'error':
                return {
                    fondo: 'bg-red-50',
                    borde: 'border-red-500',
                    titulo: 'text-red-800',
                    mensaje: 'text-red-700',
                    icono: 'text-red-600',
                };

            default:
                return {
                    fondo: 'bg-blue-50',
                    borde: 'border-blue-500',
                    titulo: 'text-blue-800',
                    mensaje: 'text-blue-700',
                    icono: 'text-blue-600',
                    simbolo: 'ℹ'
                };

        }

    }
}