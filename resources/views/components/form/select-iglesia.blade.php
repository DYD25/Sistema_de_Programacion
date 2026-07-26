@props(['iglesias', 'iglesiaSeleccionada'])

<div class="p-2 border-b border-green-800">

    <select id="selectIglesia" class="select w-full rounded-md bg-green-800 border-green-700 text-white text-sm">

        <option value="">
            Seleccione una iglesia
        </option>

        @foreach ($iglesias as $iglesia)
            <option value="{{ $iglesia->id }}" @selected($iglesiaSeleccionada == $iglesia->id)>

                {{ $iglesia->nombre }}

            </option>
        @endforeach

    </select>

</div>
