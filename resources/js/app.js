
import Alpine from 'alpinejs';
import Services from './services';
import Inicio from './inicio/inicio';

// import 'tom-select/dist/css/tom-select.css';
import './bootstrap';
import 'nprogress/nprogress.css';
import './miembro/miembros';

window.Inicio = Inicio;
window.Services = Services;
window.Alpine = Alpine;

Services.app.iniciar();
Alpine.start();

const sidebar = document.getElementById('sidebar');
const layout = document.getElementById('layout');
const header = document.getElementById('header');

document.getElementById('btn-menu').addEventListener('click', () => {

    sidebar.classList.toggle('sidebar-mini');
    sidebar.classList.toggle('w-52');
    sidebar.classList.toggle('w-20');

    layout.classList.toggle('ml-20');
    layout.classList.toggle('ml-52');

    // header.classList.toggle('ml-52');
    header.classList.toggle('-ml-18');

    document.getElementById('usuario-sidebar').classList.toggle('justify-center');
    document.querySelector('.user-info').classList.toggle('hidden');
});


