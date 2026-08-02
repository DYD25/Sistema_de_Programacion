@props([
    'title' => null,
    'subtitle' => null,
])

<section class="mb-10">

    <div class="">

        <h2 class="text-2xl font-bold text-slate-800">
            {{ $title }}
        </h2>

        @if ($subtitle)
            <p class="mt-1 text-slate-500">

                {{ $subtitle }}

            </p>
        @endif

    </div>

    {{ $slot }}

</section>
