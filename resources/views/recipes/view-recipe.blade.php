<x-filament-panels::page>

    <div class="max-w-3xl space-y-4">

        <div class="flex items-center space-x-8 text-sm -mt-4">
            <div>Submitted by&nbsp;<span class="font-bold">{{ $recipe->user->name }}</span></div>
            <div>Updated on {{ $recipe->updated_at->toFormattedDateString() }}</div>
        </div>

        <div class="flex border-t border-gray-400"></div>

        @if (isset($recipe->servings) || isset($recipe->yield))
            <div class="flex items-center space-x-8">

                <div class="flex items-center space-x-2">
                    <p class="font-bold">Servings:</p>
                    <p>{{ $recipe->servings ?? 'n/a' }}</p>
                </div>

                <div class="flex items-center space-x-2">
                    <p class="font-bold">Yield:</p>
                    <p>{{ $recipe->yield ?? 'n/a' }}</p>
                </div>

            </div>
        @endif

        @if ($preview)
            <div class="flex max-w-xl">
                <img class="h-auto max-w-full" src="{{ $preview }}" />
            </div>
        @endif

    </div>

</x-filament-panels::page>
