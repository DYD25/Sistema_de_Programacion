
import './bootstrap';  

import Alpine from 'alpinejs';
import Services from './services';


window.Services = Services;
window.Alpine = Alpine;

// Inicializar la aplicación
Services.app.iniciar();

Alpine.start();

// ==============================
// Eventos globales del sistema para el menu y encabezaddo
// ==============================
const sidebar = document.getElementById('sidebar');
const layout = document.getElementById('layout');
const header = document.getElementById('header');

document.getElementById('btn-menu').addEventListener('click', () => {

    sidebar.classList.toggle('sidebar-mini');
    sidebar.classList.toggle('w-15');//Menu mini
    layout.classList.toggle('ml-60');//Layout mini
    
    sidebar.classList.toggle('w-24');//Menu grande
    layout.classList.toggle('ml-24');//Layout grande

    header.classList.toggle('-ml--9');//Encabezado mini

    document.getElementById('usuario-sidebar')?.classList.toggle('justify-center');
    document.querySelector('.user-info')?.classList.toggle('hidden');
});


