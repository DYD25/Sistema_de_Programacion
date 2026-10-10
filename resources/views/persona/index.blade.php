<x-app-layout>

    <x-crud.header title="Personas" subtitle="Gestiona las personas">
        <x-slot:icon>
            <x-heroicon-s-user-group class="w-7 h-7 text-green-600" />
        </x-slot:icon>
        <x-slot:actions>
            <x-form.button-crear id="btn-crear" title="Crear Persona" />
        </x-slot:actions>
           
    </x-crud.header>

    <div id="panel-body">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-5">

            <x-cards.card-stat-chart title="Personal Registrados" textoSuperior="Resumen" valueId="card-total" value="0"
                subtitle="Registrados" topText="Agosto 2026">
                <div id="grafica-total-miembros" class="h-12"></div>
                <x-slot:footer>
                    <span id="crecimiento-miembros" class="text-green-600 text-xs font-semibold">
                        ▲ +0 este mes
                    </span>
                </x-slot:footer>
            </x-cards.card-stat-chart>

            <x-cards.card-stat-chart textoSuperior="Estado" title="Personal Activos" valueId="card-activos" value="0" subtitleId="porcentaje-activos" subtitle="">
                <div id="grafica-activos-miembro" class="h-12"></div>
                <x-slot:footer>
                    <span class="text-green-600 text-xs font-semibold">
                        ▲ %
                    </span>
                </x-slot:footer>
            </x-cards.card-stat-chart>

            <x-cards.card-stat-chart textoSuperior="Estado" title="Personal Inactivos" valueId="card-inactivos" value="0" subtitleId="porcentaje-inactivos" subtitle="">
                <div id="grafica-inactivos-miembro" class="h-12"></div>
                <x-slot:footer>
                    <span class="text-red-500 text-xs font-semibold">
                        ▼ %
                    </span>
                </x-slot:footer>
            </x-cards.card-stat-chart>

            <x-cards.card-stat-chart textoSuperior="Resumen" title="Estado General" valueId="card-general" value="0" subtitle="Miembros activos">

                <div id="grafica-general-miembro" class="h-12 w-full"></div>

                <x-slot:footer>

                    <span id="estado-general" class="text-green-600 text-xs font-semibold">
                        Excelente
                    </span>

                </x-slot:footer>

                </x-cards.card-stat-chart>

        </div>

        <x-crud.panel>

            <x-slot:icon>
                <x-heroicon-o-user-group class="w-6 h-6 text-green-600" />
            </x-slot:icon>

            @php
                $columnas = [
                    ['contenido' => 'Nombre Completo'],
                    ['contenido' => 'Telefono'],
                    ['contenido' => 'Fecha de Nacimiento'],
                    ['contenido' => 'Cantidad Area'],
                    ['contenido' => 'Estado'],
                    ['contenido' => 'Acciones'],
                ];
            @endphp

            <div class="overflow-x-auto">
                <x-crud.table id="table_personas" :columnas="$columnas" />
            </div>

        </x-crud.panel>

        <x-form.drawer drawerId="crear-persona" title="Crear Persona" formId="form-crear-persona" textoGuardar="Persona">

            <x-slot:icon>
                <x-heroicon-o-user class="w-7 h-7 text-green-600" />
            </x-slot:icon>

            <!-- Aquí van los inputs -->

            <div class="space-y-4">

                <x-form.input label="Nombres" name="nombres" placeholder="Ej. Plablo" :obligatorio="true"
                    maxlength="20">
                    <x-slot:icon>
                        <x-heroicon-s-user class="w-5" />
                    </x-slot:icon>
                </x-form.input>

                <x-form.input label="Apellidos" name="apellidos" placeholder="Ej. Perez Perez" :obligatorio="true"
                    maxlength="20">
                    <x-slot:icon>
                        <x-heroicon-s-user class="w-5" />
                    </x-slot:icon>
                </x-form.input>

                <!-- <div class="md:col-span-2"> -->
                    <x-form.input label="Teléfono" name="telefono" placeholder="Ej. 3112001225" :obligatorio="true">
                        <x-slot:icon>
                            <x-heroicon-s-phone class="w-5" />
                        </x-slot:icon>
                    </x-form.input>
                <!-- </div> -->

                <x-form.input label="Fecha de Nacimiento" name="fecha_nacimiento" placeholder="Ej. 2000-01-01" :obligatorio="false" type="date"
                    maxlength="50">
                    <x-slot:icon>
                        <x-heroicon-s-calendar class="w-5" />
                    </x-slot:icon>
                </x-form.input>

            </div>
        </x-form.drawer>

         <x-form.modal title="Asignar Areas/Ministerio" modal="asignar-areas" subtitle="Asigna las areas/ministerios a la persona" formId="form-asignar-areas" 
                    textoGuardar="Guardar Asignación" btnCancelar="btn-cancelar-areas">
            <x-slot:icon>
                <x-heroicon-o-tag class="w-7 h-7 text-green-600" />
            </x-slot:icon>
            
            <div class="border rounded-lg pl-4 pr-4">
                <div  id="contenedor-areas" class="grid grid-cols-1 md:grid-cols-2 gap-1">
                </div>
            </div>
        </x-form.modal>
      
    </div>

</x-app-layout>

@vite('resources/js/persona/persona_general.js')
