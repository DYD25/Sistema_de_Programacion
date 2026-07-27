export default class PasswordService {

    inicializar() {

        document.querySelectorAll('[data-password-toggle]').forEach((contenedor) => {

            const input = contenedor.querySelector('input');
            const boton = contenedor.querySelector('[data-toggle]');
            const eye = contenedor.querySelector('[data-eye]');
            const eyeSlash = contenedor.querySelector('[data-eye-slash]');

            if (!input || !boton || !eye || !eyeSlash) return;

            boton.addEventListener('click', () => {

                const mostrar = input.type === 'password';

                input.type = mostrar ? 'text' : 'password';

                eye.classList.toggle('hidden');
                eyeSlash.classList.toggle('hidden');

                boton.classList.toggle('text-[#21783E]');

            });

        });

    }

}