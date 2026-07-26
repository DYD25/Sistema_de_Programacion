@props([
    'id' => null,
    'name' => null,
    'columnas' => [],
])
<div class="w-full overflow-x-auto">
    <table id="{{ $id }}" name="{{ $name }}"
        class="w-full border-collapse bg-white shadow-sm rounded-lg overflow-hidden">

        <thead class="bg-gray-100 text-left">
            <tr>
                @foreach ($columnas as $columna)
                    <th class="px-4 py-2 font-semibold text-sm ">
                        {{ $columna['contenido'] }}
                    </th>
                @endforeach
            </tr>
        </thead>

        <tbody class="text-sm">
            {{ $slot }}
        </tbody>

    </table>
</div>
