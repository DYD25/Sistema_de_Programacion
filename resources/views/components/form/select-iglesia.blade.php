@props(['iglesias', 'iglesiaSeleccionada'])

<div class="select-iglesia p-2 border-b border-green-500">

    <select id="selectIglesia" class="select w-full rounded-md  bg-gradient-to-r from-[#21783E] via-[#1F9A72] to-[#1FA6A6] text-white text-sm">


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
