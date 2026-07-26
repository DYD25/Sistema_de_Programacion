import NProgress from 'nprogress';
export default class PeticionService {

    async request(ruta, { method = 'POST', data = {}, loader = false } = {}) {
        
        let formData = new FormData();

        // CSRF siempre
        let csrf = document.querySelector('input[name="_token"]')?.value;
        if (csrf) formData.append('_token', csrf);

        // convertir objeto o FormData
        if (data instanceof FormData) {
            for (let [key, value] of data.entries()) {
                formData.append(key, value);
            }
        } else {
            for (let key in data) {
                formData.append(key, data[key]);
            }
        }

        if (loader === 'progress') {
            NProgress.start();
        }

        if (loader?.type === 'drawer') {
            Services.drawer.loading(loader.id);
        }

        try {
            const response = await fetch(ruta, {
                method,
                body: formData
            });

            return await response.json();

        } catch (error) {
            console.error(error);
            return null;
        } finally {
            if (loader === 'progress') {
                NProgress.done();
            }

            if (loader?.type === 'drawer') {
                Services.drawer.loaded(loader.id);
            }
        }
    }
}
