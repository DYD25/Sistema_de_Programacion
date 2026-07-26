<table class="w-full text-sm">

    <thead class="bg-gray-100 text-left"> 
        <tr class="border-b">
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        @foreach($miembros as $miembro)
            <tr class="border-b hover:bg-gray-50 transition">
                <td>{{ $miembro->nombre }}</td>
                <td>{{ $miembro->telefono }}</td>
                <td>{{ $miembro->estado == 1 ? 'Habilidato':'Inabilidtado' }}</td>
            </tr>
        @endforeach
        <div class="mt-4">
            {{ $miembros->links() }}
        </div>
    </tbody>
</table>