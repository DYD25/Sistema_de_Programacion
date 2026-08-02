<x-app-layout>

    {{-- Hero --}}
    @include('dashboard.sections.welcome')

    {{-- Indicadores --}}
    @include('dashboard.sections.statistics')

    {{-- Primera fila --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-20">
        <div>
            @include('dashboard.sections.weekly-schedule')
        </div>

        <div>
            @include('dashboard.sections.survey-status')
        </div>

        <div >
            @include('dashboard.sections.activity')
        </div>
    </div>

    {{-- Segunda fila --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">

        @include('dashboard.sections.pending-responses')

        @include('dashboard.sections.active-servers')


    </div>

    {{-- Última fila --}}
    @include('dashboard.sections.recent-activity')

</x-app-layout>
