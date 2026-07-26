import AppService from "./app.service";
import PeticionService from './peticion.service';
import DrawerService from './drawer.service';
import AlertaService from './alerta.service';
import TablaService from './tabla.service';
import ModalService from './modal.service';
import FormularioService from './formulario.service';
import AccionService from './accion.service';
import IglesiaService from './iglesia.service';
import SelectService from './select.service';
import CardService from './card.service';
import ChartService from './chart.service';
import NotificacionService  from './notificacion.service';    
import TooltipService from './tooltip.service';

const Services = {
    app: new AppService(),
    
    peticion: new PeticionService(),
    alerta: new AlertaService(),
    notificacion: new NotificacionService(),
    tabla: new TablaService(),
    modal: new ModalService(),
    drawer: new DrawerService(),
    formulario: new FormularioService(),
    accion: new AccionService(),
    iglesia: new IglesiaService(),
    select: new SelectService(),
    card: new CardService(),
    chart: new ChartService(),
    tooltip: new TooltipService(),

};

export default Services;