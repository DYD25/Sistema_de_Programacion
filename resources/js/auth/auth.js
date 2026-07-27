import '../bootstrap';

import Alpine from 'alpinejs';
import PasswordService from './password.service';

window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', () => {

    new PasswordService().inicializar();

});

Alpine.start();