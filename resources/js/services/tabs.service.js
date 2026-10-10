export default class TabsService {
    iniciar() {

        document.querySelectorAll('[data-tabs]').forEach(contenedor => {

            let botones = contenedor.querySelectorAll('[data-tab]');
            let contenido = document.getElementById(`${contenedor.id}-content`);

            let cargarVista = async (boton) => {
                contenedor.dataset.tabActivo = boton.dataset.tab;
                let ruta = boton.dataset.ruta;

                if (!ruta || !contenido) return;

                contenido.innerHTML = `
                    <div class="flex justify-center py-10">
                        <span class="text-sm text-gray-500">
                            Cargando...
                        </span>
                    </div>
                `;

                try {
                    let response = await fetch(ruta);

                    if (!response.ok) {
                        throw new Error('No se pudo cargar la vista');
                    }

                    contenido.innerHTML = await response.text();
                    if (boton.dataset.tab === 'directivas') {
                        import('../directiva/directiva.js').then(modulo => modulo.default?.iniciar?.());
                    }


                } catch (error) {

                    console.error(error);
                    contenido.innerHTML = ` <div class="p-4 text-red-600">
                            Error al cargar el contenido.
                        </div>
                    `;
                }
            };

            botones.forEach(boton => {
                boton.addEventListener('click', async () => {
                    botones.forEach(btn => {
                        btn.classList.remove('border-[#14532D]', 'text-[#14532D]');
                        btn.classList.add('border-transparent', 'text-slate-500');
                    });

                    boton.classList.remove('border-transparent', 'text-slate-500');
                    boton.classList.add('border-[#14532D]', 'text-[#14532D]');

                    await cargarVista(boton);
                });
            });

            // Cargar tab activo inicialmente
            let tabActivo = contenedor.dataset.tabActivo;
            let botonActivo = contenedor.querySelector(`[data-tab="${tabActivo}"]`);

            if (botonActivo) {
                cargarVista(botonActivo);
            }
        });
    }
}